<?php

namespace App\Http\Resources\Admin\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title'=>$this->title,
            'body' => $this->body,
            // 'type' => $this->type,
            // 'type' => class_basename($this->notifiable_type),
            'name' => $this->notifiable?->name, // Returns the related model's name
            // 'notifiable' => [
            //     'id' => $this->notifiable_id,

            //     'name' => $this->notifiable->name, // Returns the related model
            //     'phone' => $this->notifiable->phone // Returns the related model
            // ],
            // 'is_read' => (bool) $this->is_read,
            // 'read_at' => $this->read_at?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
