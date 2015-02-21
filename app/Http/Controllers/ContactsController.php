<?php namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;

class ContactsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contacts = Contact::with('organization', 'publicMessagesCount')->get();

		return view('contacts.index', compact('contacts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$organizations = \App\Organization::lists('name', 'id');

		return view('contacts.create', compact('organizations'));
	}

	/**
	 * Store the organization's id then redirect to the new resource form.
	 *
	 * @param $id
	 * @return Response
	 */
	public function createFromOrganization($id)
	{
		session()->flash('organization_id', $id);

		return redirect('contacts/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param ContactRequest $request
	 * @return Response
	 */
	public function store(ContactRequest $request)
	{
		$contaxt = Contact::create($request->all());
		$name = $contaxt->name;

		session()->flash('flash_message', 'The contact "' . $name . '" has been created.');

		return redirect('contacts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contact = Contact::with('organization', 'publicMessagesCount')->findOrFail($id);

		return view('contacts.show', compact('contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contact = Contact::findOrFail($id);

		$organizations = $contact->organization()->lists('name', 'id');

		return view('contacts.edit', compact('contact', 'organizations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param ContactRequest $request
	 * @return Response
	 */
	public function update($id, ContactRequest $request)
	{
		$contact = Contact::findOrFail($id);

		$contact->update($request->all());

		return redirect("contacts/{$id}");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//$contact = Contact::findOrFail($id);
		//$name = $contact->name;
        //
		//$contact->delete();
        //
		//session()->flash('flash_message', 'The contact "' . $name . '" has been removed.');
        //
		//return redirect('contacts');

		// contacts can't be deleted, their information needs to be retained so there is a record to go along with the ticket
		// only contacts that have been used can be deleted
	}

}
