<?php namespace App\Http\Controllers\Frontend;

use App\Ticket;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;

class TicketsController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($id, $slug)
	{
		$ticket = Ticket::with('organization', 'publicMessages.files')->whereId($id)->whereSlug($slug)->firstOrFail();

		return view('frontend.tickets.show', compact('ticket'));
	}

}
