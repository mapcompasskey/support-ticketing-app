<?php namespace App\Http\Controllers;

use App\PrivateMessage;
use App\Http\Requests\PrivateMessageRequest;
use App\Http\Controllers\Controller;

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

		PrivateMessage::create($input);

		session()->flash('new_private_message', true);

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