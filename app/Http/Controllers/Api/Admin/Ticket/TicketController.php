<?php

namespace App\Http\Controllers\Api\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketAddMessageRequest;
use App\Http\Requests\Admin\Ticket\TicketUpdateStatusRequest;
use App\Http\Resources\Admin\Ticket\TicketIndexResource;
use App\Models\Admin;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tickets = Ticket::paginate();
        return $this->respondResource(TicketIndexResource::collection($tickets));
    }




    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        return $this->respondResource(new TicketIndexResource($ticket));
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
        $ticket->delete();
        return $this->respondWithSuccess(__('general.deleted_successfully'));
    }

    public function addMessage(Ticket $ticket, TicketAddMessageRequest $request)
    {
        $data = $request->validated();
        $data['sender_type'] = Admin::class;
        $data['sender_id'] = authUser('admin')->id;

        // dd($ticket->createdBy);
        $ticket->ticketMessage()->create($data);

        return $this->respondResource(new TicketIndexResource($ticket), [
            'message' => __('general.Created successfully')
        ]);
    }
    public function updateStatus(Ticket $ticket, TicketUpdateStatusRequest $request)
    {
        $data = $request->validated();
        $ticket->update($data);
        return $this->respondResource(new TicketIndexResource($ticket), [
            'message' => __('general.Updated successfully')
        ]);
    }
}
