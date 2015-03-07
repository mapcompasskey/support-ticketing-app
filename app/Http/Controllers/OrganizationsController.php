<?php namespace App\Http\Controllers;

use App\Organization;
use App\Http\Requests\OrganizationRequest;
use App\Http\Controllers\Controller;

class OrganizationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizations = Organization::with('ticketsCount')->orderById()->get();

		return view('organizations.index', compact('organizations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('organizations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param OrganizationRequest $request
	 * @return Response
	 */
	public function store(OrganizationRequest $request)
	{
		$organization = Organization::create($request->all());

		session()->flash('flash_message', "The organization \"{$organization->name}\" has been created.");

		return redirect('organizations');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$organization = Organization::with('tickets')->findOrFail($id);

		return view('organizations.show', compact('organization'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$organization = Organization::findOrFail($id);

		return view('organizations.edit', compact('organization'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param OrganizationRequest $request
	 * @return Response
	 */
	public function update($id, OrganizationRequest $request)
	{
		$organization = Organization::findOrFail($id);

		$organization->update($request->all());

		return redirect("organizations/{$id}");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$organization = Organization::findOrFail($id);
		$name = $organization->name;

		$organization->delete();

		session()->flash('flash_message', "The organization \"{$name}\" has been removed.");

		return redirect('organizations');
	}

}
