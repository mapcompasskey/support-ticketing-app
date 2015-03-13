<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\PublicMessageFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicMessageFilesController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int $filename
	 * @return Response
	 */
	public function show($filename)
	{
		$publicMessageFile = PublicMessageFile::whereFilename($filename)->firstOrFail();
		$file = Storage::get('messages/public/' . $publicMessageFile->filename);

		$headers = array();
		$headers['Content-type'] = $publicMessageFile->mime;

		// force the file download if its not an image
		if ( ! $publicMessageFile->isImage())
		{
			$headers['Content-Disposition'] = 'attachment; filename="' . $publicMessageFile->filename . '"';
		}

		return response($file, 200, $headers);
	}

}
