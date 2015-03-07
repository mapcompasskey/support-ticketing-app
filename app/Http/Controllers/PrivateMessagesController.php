<?php namespace App\Http\Controllers;

use App\Ticket;
use App\PrivateMessage;
use App\Http\Requests\PrivateMessageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PrivateMessagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$messages = PrivateMessage::orderByCreated()->get();
        //
		//return view('messages.index', compact('messages'));
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
	 * @param PrivateMessageRequest $request
	 * @return Response
	 */
	public function store(PrivateMessageRequest $request)
	{
		$request['user_id'] = 1;

		// get ticket
		$ticket = Ticket::findOrFail($request['ticket_id']);

		// add new private message
		$message = new PrivateMessage($request->all());
		$ticket->privateMessages()->save($message);

		// add or remove private contact
		if ($request['private_notify'])
		{
			if ( ! $ticket->users()->find($request['user_id']))
			{
				$ticket->users()->attach([$request['user_id']]);
			}
		}
		else
		{
			$ticket->users()->detach([$request['user_id']]);
		}

		Session::flash('new_private_message_id', $message->id);

		return redirect("tickets/{$ticket->id}#private-message{$message->id}");
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
		//
	}

}
