<?php

namespace App\Http\Controllers\Api\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\StoreNotificationRequest;
use App\Http\Resources\Admin\Notification\NotificationIndexResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notifiactions = Notification::where('type', 'LIKE', 'DASHBOARD_%')->orderBy('id', 'desc')->paginate();
        return $this->respondResource(NotificationIndexResource::collection($notifiactions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        
        $data = $request->validated();


        $targetAudience = $request->input('target_audience');




        $deviceTokens = [];

        // Handle notification targets
        switch ($targetAudience) {
            case 'all_users':
                // Get all users' device tokens
                $deviceTokens = User::whereNotNull('fcm_token')
                    ->pluck('fcm_token');
                $notifiable_type = User::class;
                $notifiable_id = null;
                $request->type = 'DASHBOARD_ALL_USERS';
                break;

            case 'specific_user':
                // Validate specific user exists
                if (!$request->has('specific_user')) {
                    return $this->setStatusCode(422)->respondWithError(__('Specific user ID is required'));
                }

                $user = User::where('id', $request->specific_user)
                    ->firstOrFail();

                $deviceTokens = [$user->fcm_token];
                $notifiable_type = User::class;
                $notifiable_id = $request->specific_user;
                $request->type = 'DASHBOARD_SPECIFIC_USER';
                break;

            
                
            default:
                throw new \InvalidArgumentException('Invalid target audience specified');
        }


        $notificationData = [
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'body_ar' => $request->body_ar,
            'body_en' => $request->body_en,
            'type' => $request->type,

        ];


        Notification::create(
            [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'body_ar' => $request->body_ar,
                'body_en' => $request->body_en,
                'type' => $request->type,
                'notifiable_type' => $notifiable_type,
                'notifiable_id' => $notifiable_id,
            ]
        );


        if (!empty($deviceTokens)) {


            notifyViaFirebase([
                'title' => $notificationData['title_ar'],
                'body' => $notificationData['body_ar'] ?? null,
                'image' => null,
                'type' => $notificationData['type'] ?? null,
                'subject_id' =>  null,
            ], $deviceTokens);
        }



        return $this->respondWithSuccess(__('general.Created successfully'));
        // return $this->respondResource(new NotificationIndexResource($notifiaction),[
        //     'message'=>__('general.Created successfully')
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
        return $this->respondResource(new NotificationIndexResource($notification));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
        $notification->delete();
        return $this->respondWithSuccess(__('general.deleted_successfully'));
    }
}
