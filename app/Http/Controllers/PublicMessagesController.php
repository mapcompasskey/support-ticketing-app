<?php namespace App\Http\Controllers;

use App\PublicMessage;
use App\Http\Requests\PublicMessageRequest;
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
	 * @return Response
	 */
	public function store(PublicMessageRequest $request)
	{
		$input = $request->all();

		// add new email contact if doesn't exist
		$contact = \App\TicketContact::where('ticket_id', '=', $input['ticket_id'])->where('email', '=', $input['email'])->get();
		if ($contact->isEmpty())
		{
			$ticket = \App\Ticket::find($input['ticket_id']);
			$ticket->ticketContacts()->create($request->all());
		}

		// add new public message
		$message = PublicMessage::create($request->all());

		Session::flash('new_public_message_id', $message->id);

		return redirect("tickets/{$message['ticket_id']}#new-message");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
		// i need to add a unique string for the unsubscribe link
		// i'll give them an "unsubscribe" link in the email message
		// that will open a page and match their email and the unique
		// string against the database to the `ticket_contacts` to remove
	}

}
