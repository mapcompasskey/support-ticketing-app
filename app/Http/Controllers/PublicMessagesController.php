<?php namespace App\Http\Controllers;

use App\Ticket;
use App\PublicMessage;
use App\PublicContact;
use App\PublicMessageFile;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\PublicContactRequest;
use Illuminate\Support\Facades\Event;
use App\Events\PublicMessageFileWasPosted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PublicMessagesController extends Controller {

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
		$ticket = Ticket::findOrFail($request['ticket_id']);

		// add new message
		$message = $this->addNewPublicMessage($ticket, $request, $contactRequest);

		return redirect("tickets/{$ticket->id}#public-message{$message->id}");
	}

	/**
	 * Add a new public message.
	 *
	 * @param Ticket $ticket
	 * @param PublicMessageRequest $request
	 * @param PublicContactRequest $contactRequest
	 * @return PublicMessage
	 */
	public function addNewPublicMessage(Ticket $ticket, PublicMessageRequest $request, PublicContactRequest $contactRequest)
	{
		// if a file was posted
		$publicMessageFile = new PublicMessageFile();
		if ($request->file('file'))
		{
			// save the file into storage and update the eloquent model
			Event::fire(new PublicMessageFileWasPosted($request->file('file'), $publicMessageFile));
		}

		// add a new public message
		$message = new PublicMessage($request->all());
		$ticket->publicMessages()->save($message);

		// add new file
		if ($publicMessageFile->toArray())
		{
			$message->files()->save($publicMessageFile);
		}

		// add a new public contact
		$this->addNewPublicContact($ticket, $request, $contactRequest);

		Session::flash('new_public_message_id', $message->id);

		return $message;
	}

	/**
	 * Add a new public contact.
	 *
	 * @param Ticket $ticket
	 * @param PublicMessageRequest $request
	 * @param PublicContactRequest $contactRequest
	 */
	public function addNewPublicContact(Ticket $ticket, PublicMessageRequest $request, PublicContactRequest $contactRequest)
	{
		// add new (or update) public contact
		if ($request['public_notify'] || $request['notify'])
		{
			$contact = PublicContact::firstOrNew([
				'ticket_id' => $ticket->id,
				'email' => $contactRequest['email']
			]);

			// create an unsubscribe slug if there isn't one
			if (is_null($contact->unsubscribe_slug))
			{
				$contactRequest['unsubscribe_slug'] = rand(1000000000, 9999999999);
			}

			$contact->fill($contactRequest->all());
			$ticket->publicContacts()->save($contact);
		}
	}

}
