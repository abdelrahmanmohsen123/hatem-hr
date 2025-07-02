<?php

use App\Models\Setting;
use App\Traits\ApiResponder;
use Google\Client;

if (!function_exists('uploadsPath')) {
    /**
     * @param $postfix
     * @return mixed|string|null
     */
    function uploadsPath($postfix = null)
    {
        if ($postfix == null)
            return null;

        if (filter_var($postfix, FILTER_VALIDATE_URL)) {
            return $postfix;
        }
        return asset('storage/' . $postfix);
    }
}

if (!function_exists('settings')) {
    function settings($key = null)
    {
        $settings = Setting::first();
        return $key ? $settings[$key] : $settings;
    }
}


/**
 * Get the authenticated user for the given guard.
 *
 * @param string $guard The authentication guard name (e.g., 'admin', 'user', 'collector')
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
if (! function_exists('authUser')) {
    function authUser(string $guard): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->guard($guard)->user();
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        return request()->header('lang', 'ar');
    }
}


if (!function_exists('notifyViaFirebase')) {
    function notifyViaFirebase($data, $to = null, $isTopic = false, $type = 'notification')
    {

        $to = collect($to)->filter();

        if ($type === 'notification') {
            $data = array_merge([
                'title' => $data['title'] ?? '',
                'body' => $data['body'] ?? '',
                'type' => $data['type'] ?? '',
                'subject_id' => '',
                'order_id' => $data['order_id'] ?? '',
                'image' => $data['image'] ?? '',
            ]);
            // dd($data);
        }
        $tokenCurls = [];
        // Prepare FCM message payload
        if ($isTopic && !is_array($to)) {
            $fields = [
                'message' => [
                    'topic' => 'general',
                    'notification' => [
                        'title' => $data['title'],
                        'body' => $data['body'],

                    ],
                    'data' => [
                        'type' => $data['type'],
                        'subject_id' => $data['subject_id'],
                        'order_id' => $data['order_id'],
                        'vibrate' => '1',
                        'badge' => '1',
                        'sound' => 'alarm.mp3',
                    ],
                    'android' => [
                        'notification' => [
                            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            'image' => $data['image']

                        ]
                    ],
                ],
            ];
        } else {
            foreach ($to as $token) {
                $tokenCurls[] = [
                    'message' => [
                        'token' => $token,
                        'notification' => [
                            'title' => $data['title'],
                            'body' => $data['body'],

                        ],
                        'data' => [
                            'type' => $data['type'],
                            'subject_id' => $data['subject_id'],
                            'order_id' => $data['order_id'],
                            'vibrate' => '1',
                            'badge' => '1',
                        ],
                        'android' => [
                            'notification' => [
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                'channel_id' => 'high_importance_channel',
                                "sound" => "notification",
                                "image" => $data['image']

                            ]
                        ],
                        'apns' => [
                            'payload' => [
                                'aps' => [
                                    'alert' => [
                                        'title' => $data['title'],
                                        'body' => $data['body'],
                                    ],
                                    'sound' => 'notification.caf',
                                    'content-available' => 1,
                                    'badge' => 1,
                                    'category' => 'FLUTTER_NOTIFICATION_CLICK',
                                ],
                            ],
                            'headers' => [
                                'apns-priority' => '10',
                            ],
                        ],
                    ],
                ];
            }
        }
        sendNotifications($tokenCurls);
    }
}


if (!function_exists('sendNotifications')) {
    function sendNotifications($notifications)
    {

        $serviceAccountPath = storage_path('app/private/firebase-auth.json');
        $projectId = 'el-mohtaref-2be8e';
        $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';
        $accessToken = getAccessToken($serviceAccountPath);

        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];


        $multiCurl = array();
        $mh = curl_multi_init();
        curl_multi_setopt($mh, CURLMOPT_PIPELINING, CURLPIPE_MULTIPLEX);

        foreach ($notifications as $i => $notification) {
            $multiCurl[$i] = curl_init();
            curl_setopt($multiCurl[$i], CURLOPT_URL, $url);
            curl_setopt($multiCurl[$i], CURLOPT_HTTPHEADER, $headers);
            curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($multiCurl[$i], CURLOPT_POST, true);
            curl_setopt($multiCurl[$i], CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($multiCurl[$i], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($multiCurl[$i], CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
            curl_setopt($multiCurl[$i], CURLOPT_POSTFIELDS, json_encode($notification, JSON_UNESCAPED_UNICODE));
            curl_multi_add_handle($mh, $multiCurl[$i]);
        }

        $index = null;
        do {
            curl_multi_exec($mh, $index);
            curl_multi_select($mh);
        } while ($index > 0);

        foreach ($multiCurl as $k => $ch) {
            $result[$k] = curl_multi_getcontent($ch);
            if (curl_errno($ch)) {
                \Log::error('Firebase API error: ' . curl_error($ch));
            }
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);
        // \Log::info($result);

        // dd($result);
        // print_r($result);
    }
}

if (!function_exists('getAccessToken')) {
    function getAccessToken($serviceAccountPath)
    {
        $client = new Client();
        $client->setAuthConfig($serviceAccountPath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->useApplicationDefaultCredentials();
        $token = $client->fetchAccessTokenWithAssertion();
        return $token['access_token'];
    }
}
