<?php

namespace App\Http\Controllers\Api\Admin\Notification;

use App\Models\User;
use App\Models\Notification;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Support\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\StoreNotificationRequest;
use App\Http\Resources\Admin\Notification\NotificationIndexResource;

class NotificationController extends Controller
{
    use ApiResponder;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $notifiactions = Notification::orderBy('id', 'desc')->paginate();
        return $this->respondResource(NotificationIndexResource::collection($notifiactions));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {

        $data = $request->validated();
        if ($request->image) {
            $data['image'] = (new FileUploader())->save($request->image, 'notificatios');
        }


        $notifiaction = Notification::create(
            [
                'title' => $data['title'],
                'body' => $data['body'],
                'type' => $data['type'],
                'image' => $data['image'],
            ]
        );
        // notifyViaFirebase($notifiaction->type, $notifiaction->title, $notifiaction->body, uploadsPath($notifiaction->image), $dataa = [], $tokens = []);

        

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
