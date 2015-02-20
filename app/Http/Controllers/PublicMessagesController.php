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
		$input['user_id'] = 1;
		$input['contact_id'] = 0;

		$message = PublicMessage::create($input);

		Session::flash('new_public_message_id', $message->id);

		return redirect("tickets/{$input['ticket_id']}#new-message");
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
