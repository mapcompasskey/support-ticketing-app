<?php namespace App\Http\Controllers;

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
		$input = $request->all();
		$input['user_id'] = 1;

		$message = PrivateMessage::create($input);

		// add or remove user from receiving notifications
		$ticket = \App\Ticket::find($message->ticket_id);
		if ($request['notify'])
		{
			if ( ! $ticket->users()->find($input['user_id']))
			{
				$ticket->users()->attach([$input['user_id']]);
			}
		}
		else
		{
			$ticket->users()->detach([$input['user_id']]);
		}

		Session::flash('new_private_message_id', $message->id);

		return redirect("tickets/{$message->ticket_id}#new-message");
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
