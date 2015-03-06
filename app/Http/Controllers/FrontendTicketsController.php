<?php namespace App\Http\Controllers;

use App\Ticket;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendTicketsController extends Controller {

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
		echo '<pre>' . print_r($request->all(), true) . '</pre>';

		$ticket = Ticket::whereId($request['ticket_id'])->whereSlug($request['ticket_slug'])->firstOrFail();
		echo '<pre>' . print_r($ticket->toArray(), true) . '</pre>';

		/*
		// add new public message
		$message = PublicMessage::create($request->all());

		// add new (or update) public contact
		if ($request['notify'])
		{
			$contact = PublicContact::firstOrNew([
				'ticket_id' => $contactRequest['ticket_id'],
				'email' => $contactRequest['email']
			]);
			$contact->fill($contactRequest->all())->save();
		}

		Session::flash('new_public_message_id', $message->id);

		return redirect("tickets/{$message->ticket_id}#new-message");
		*/
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
		$ticket = Ticket::with('organization', 'publicMessages')->whereId($id)->whereSlug($slug)->firstOrFail();

		return view('frontend.tickets.show', compact('ticket'));
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
