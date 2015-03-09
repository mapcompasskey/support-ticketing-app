<?php namespace App\Http\Controllers\Frontend;

use App\Ticket;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\PublicContactRequest;
use App\Http\Controllers\PublicMessagesController as BaseController;

class PublicMessagesController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @param PublicMessageRequest $request
     * @param PublicContactRequest $contactRequest
     * @return Response
     */
    public function store(PublicMessageRequest $request, PublicContactRequest $contactRequest)
    {
        // get ticket
        $ticket = Ticket::whereId($request['ticket_id'])->whereSlug($request['ticket_slug'])->firstOrFail();

        // add new message
        $message = $this->addNewPublicMessage($ticket, $request, $contactRequest);

        return redirect("x/{$ticket->id}/{$ticket->slug}#msg{$message->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
