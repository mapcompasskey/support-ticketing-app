<?php namespace App\Http\Controllers\Frontend;

use App\Ticket;
use App\PublicMessage;
use App\PublicContact;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\PublicContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PublicMessagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PublicMessageRequest $request
     * @param PublicContactRequest $contactRequest
     * @return Response
     */
    public function store(PublicMessageRequest $request, PublicContactRequest $contactRequest)
    {
        $ticket = Ticket::whereId($request['ticket_id'])->whereSlug($request['ticket_slug'])->firstOrFail();

        // add new public message
        $message = new PublicMessage($request->all());
        $ticket->publicMessages()->save($message);

        // add new (or update) public contact
        if ($request['notify'])
        {
            $contact = PublicContact::firstOrNew([
                'ticket_id' => $ticket->id,
                'email' => $contactRequest['email']
            ]);
            $contact->fill($contactRequest->all())->save();
        }

        Session::flash('new_public_message_id', $message->id);

        return redirect("x/{$ticket->id}/{$ticket->slug}#msg{$message->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  string  $slug
     * @return Response
     */
    public function show($id, $slug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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
