<?php namespace App\Http\Controllers\Frontend;

use App\Ticket;
use App\PublicMessageFile;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\PublicContactRequest;
use Illuminate\Support\Facades\Event;
use App\Events\PublicMessageFileWasPosted;
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

        // if a file was posted
        $publicMessageFile = new PublicMessageFile();
        if ($request->file('file'))
        {
            // save the file into storage and update the eloquent model
            Event::fire(new PublicMessageFileWasPosted($request->file('file'), $publicMessageFile));
        }

        // add new message
        $message = $this->addNewPublicMessage($ticket, $request, $contactRequest);

        // add new file
        if ($publicMessageFile->toArray())
        {
            $message->files()->save($publicMessageFile);
        }

        return redirect("x/{$ticket->id}/{$ticket->slug}#msg{$message->id}");
    }

}
