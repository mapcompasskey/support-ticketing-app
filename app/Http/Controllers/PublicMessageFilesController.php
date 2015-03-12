<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\PublicMessageFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;

class PublicMessageFilesController extends Controller {

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
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $name
	 * @return Response
	 */
	public function show($name)
	{
		$publicMessageFile = PublicMessageFile::whereName($name)->firstOrFail();
		$file = Storage::disk('local')->get($publicMessageFile->name);

		$headers = array(
			'Content-type'        => $publicMessageFile->mime,
			'Content-Disposition' => 'attachment; filename="' . $publicMessageFile->name . '"'
		);
		return Response::make($file, 200, $headers);
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
