<?php namespace App\Http\Controllers;

use App\Ticket;
use App\Http\Requests\TicketsRequest;
use App\Http\Controllers\Controller;

class TicketsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tickets = Ticket::orderByUpdated()->get();

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

		return view('tickets.create', compact('organizations'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param TicketsRequest $request
	 * @return Response
	 */
	public function store(TicketsRequest $request)
	{
		$input = $request->all();
		$input['slug'] = strtolower(str_random(10)); // need to check if its been used

		$ticket = Ticket::create($input);
		$name = $ticket->name;

		session()->flash('flash_message', 'The ticket "' . $name . '" has been created.');

		return redirect('tickets');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ticket = Ticket::findOrFail($id);

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

		return view('tickets.edit', compact('ticket', 'organizations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param TicketsRequest $request
	 * @return Response
	 */
	public function update($id, TicketsRequest $request)
	{
		$ticket = Ticket::findOrFail($id);

		$ticket->update($request->all());

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

}
