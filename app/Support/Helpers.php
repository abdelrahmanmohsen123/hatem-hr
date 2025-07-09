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

function getAccessToken($serviceAccountPath)
{
    $client = new Client();
    $client->setAuthConfig($serviceAccountPath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->useApplicationDefaultCredentials();
    $token = $client->fetchAccessTokenWithAssertion();
    return $token['access_token'];
}


function notifyViaFirebase($topic = null, $title = null, $body = null, $image = null, $dataa = [], $tokens = [])
{
    // $SERVER_API_KEY = settings('firebase_api_access_key');
    
    $serviceAccountPath = storage_path('app/private/firebase-auth.json');
    $projectId = 'el-mohtaref-2be8e';
    $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';
    // Get access token using service account
    $accessToken = getAccessToken($serviceAccountPath);

    // Prepare notification data
    $data = [
        'title' => $title ?? '',
        'body' => $body ?? '',

        'image' => $image ?? '',  // Optional image
        // 'news_id' => isset($dataa['news_id']) ? (string) $dataa['news_id']: null,
        'type' => isset($dataa['type']) ? (string) $dataa['type'] : null, // Default type
        'notification_id' => isset($dataa['notification_id']) ? (string) $dataa['notification_id'] : '',
        'news' => $dataa['news'] ?? null,
        // 'click_action' => 'FLUTTER_NOTIFICATION_CLICK', // For Android,
        // 'sound' => 'alarm',
    ];

    // Prepare the payload
    $messagePayload = [
        'notification' => [
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $data['image'],

        ],
        'data' => [
            'vibrate' => '1',
            'badge' => '1',
            // 'sound' => 'notification',
            'image' => $data['image'],

            // 'match_id' => $data['match_id'], // Pass match_id here
            // 'news_id' => isset($data['news_id']) ? $data['news_id'] : null,
            'type' => isset($data['type']) ? $data['type'] : null, // Default type
            'notification_id' => isset($data['notification_id']) ? (string) $data['notification_id'] : '',
            'news' => isset($data['news']) ? (string) $data['news'] : '' ?? null,
            // 'click_action' => 'FLUTTER_NOTIFICATION_CLICK', // For Android
        ],
        'android' => [
            'ttl' => '660s',  // Set TTL here
            // The TTL (time-to-live) value is added in the android section as 'ttl' => $ttl, which defaults to "3600s" (1 hour) but can be overridden by passing a different value.
            // Set TTL to "0s" if you want messages to not be stored and to be discarded if the device is offline.
            'priority' => 'high',
            'notification' => [
                'channel_id' => 'notify',
                // 'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'image' => $data['image'], // Image URL for Android
                'sound' => 'notification',   // Add this line. Use the base name of the sound file in res/raw.
            ],
        ],
        'apns' => [

            'payload' => [

                'aps' => [
                    'alert' => [
                        'title' => $data['title'],
                        'body' => $data['body'],
                    ],
                    'content-available' => 1,
                    'sound' => 'notification.wav',
                    'badge' => 1,
                    // 'category' => 'FLUTTER_NOTIFICATION_CLICK',

                ],
            ],
            'headers' => [
                'apns-priority' => '10',
            ],
        ],
    ];

    // If tokens are provided, send to tokens
    $responses = [];
    if (!empty($tokens)) {
        foreach ($tokens as $token) {
            $messagePayload['token'] = $token;
            $fields = ['message' => $messagePayload];
            // dd ($fields);

            $responses[] = sendFirebaseNotification($fields, $accessToken, $url);
        }
        return $responses;
    } else {
        // Otherwise, send to the topic (fallback to 'general' topic if not provided)
        $messagePayload['topic'] = $topic ?? 'general';
    }

    // Prepare the fields for the notification
    $fields = [
        'message' => $messagePayload,
    ];

    // Send notification
    return sendFirebaseNotification($fields, $accessToken, $url);
}

// Function to send the notification
function sendFirebaseNotification($fields, $accessToken, $url)
{
    $headers = [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, JSON_UNESCAPED_UNICODE));

    $result = curl_exec($ch);
    // dd($result);


    if (curl_errno($ch)) {
        // Handle error
        $error_msg = curl_error($ch);
        curl_close($ch);
        throw new \Exception('Firebase Notification failed: ' . $error_msg);
    }

    curl_close($ch);
    return $result;
}
