<?php namespace App\Http\Controllers;

use App\Ticket;
use App\Http\Requests\TicketRequest;
use App\Http\Controllers\Controller;

class TicketsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tickets = Ticket::with('organization', 'privateMessagesCount', 'publicMessagesCount')->orderByUpdated()->get();

		return view('tickets.index', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$organizations = \App\Organization::lists('name', 'id');

		$users = \App\User::lists('name', 'id');

		return view('tickets.create', compact('organizations', 'users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param TicketRequest $request
	 * @return Response
	 */
	public function store(TicketRequest $request)
	{
		$input = $request->all();
		$input['slug'] = strtolower(str_random(10)); // need to check if its unique

		$ticket = Ticket::create($input);
		$name = $ticket->name;

		// update users in pivot table
		$this->syncUsers($ticket, $request->input('user_list'));

		session()->flash('flash_message', 'The ticket "' . $name . '" has been created.');

		if ($input['notify'] == 1)
		{
			return redirect("tickets/{$ticket->id}/notify");
		}

		return redirect('tickets');
	}

	/**
	 * Display the specified resource with the notification form.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function notify($id)
	{
		$ticket = Ticket::with('organization', 'publicMessagesCount')->findOrFail($id);

		// can't send notification if there is already a public message
		if ($ticket->publicMessagesCount)
		{
			if ($ticket->publicMessagesCount->aggregate)
			{
				return redirect("tickets/{$id}");
			}
		}

		return view('tickets.notify', compact('ticket'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = Ticket::with('organization', 'privateMessages.user', 'publicMessages', 'publicMessagesContacts', 'publicContacts', 'users')->findOrFail($id);

		return view('tickets.show', compact('ticket'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ticket = Ticket::findOrFail($id);

		$organizations = \App\Organization::lists('name', 'id');

		$users = \App\User::lists('name', 'id');

		return view('tickets.edit', compact('ticket', 'organizations', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param TicketRequest $request
	 * @return Response
	 */
	public function update($id, TicketRequest $request)
	{
		$ticket = Ticket::findOrFail($id);

		$ticket->update($request->all());

		// update users in pivot table
		$this->syncUsers($ticket, $request->input('user_list'));

		return redirect("tickets/{$id}");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$ticket = Ticket::findOrFail($id);
		$name = $ticket->name;

		$ticket->delete();

		session()->flash('flash_message', 'The ticket "' . $name . '" has been removed.');

		return redirect('tickets');
	}

	/**
	 * Sync up the list of users in the database.
	 *
	 * @param Ticket $ticket
	 * @param array $users (or null)
	 */
	private function syncUsers(Ticket $ticket, $users)
	{
		$users = (is_array($users) ? $users : []);
		$ticket->users()->sync($users);
	}

}
