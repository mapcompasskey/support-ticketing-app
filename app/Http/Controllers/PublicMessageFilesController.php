<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\PublicMessageFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
	 * @param  int $filename
	 * @return Response
	 */
	public function show($filename)
	{
		$publicMessageFile = PublicMessageFile::whereFilename($filename)->firstOrFail();

		//$file = Storage::disk('local')->get($publicMessageFile->filename);
		$file = Storage::get($publicMessageFile->filename);

		$headers = array();
		$headers['Content-type'] = $publicMessageFile->mime;

		// force a download if not an image
		if ($publicMessageFile->filetype != 'image')
		{
			$headers['Content-Disposition'] = 'attachment; filename="' . $publicMessageFile->filename . '"';
		}

		//return Response::make($file, 200, $headers);
		return response($file, 200, $headers);
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
