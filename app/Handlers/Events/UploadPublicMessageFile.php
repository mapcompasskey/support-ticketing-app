<?php namespace App\Handlers\Events;

use App\Events\PublicMessageFileWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadPublicMessageFile {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PublicMessageFileWasPosted  $event
	 * @return void
	 */
	public function handle(PublicMessageFileWasPosted $event)
	{
		$extension = $event->uploadedFile->getClientOriginalExtension();
		if ($extension != '')
		{
			// get the file's name
			$name = $event->uploadedFile->getClientOriginalName();
			//$name = substr($name, 0, strrpos($name, '.'));

			// clean up the filename
			$baseFilename = $event->uploadedFile->getClientOriginalName();
			$baseFilename = strtolower($baseFilename);
			$baseFilename = substr($baseFilename, 0, strrpos($baseFilename, '.'));
			$baseFilename = substr($baseFilename, 0, 200);
			$baseFilename = preg_replace('/[ \.\_]+/i', '-', $baseFilename);
			$baseFilename = preg_replace('/[^a-z0-9\-]+/i', '', $baseFilename);
			$baseFilename = date('Y-m-d-') . $baseFilename;

			// make sure the filename is unique
			$filename = $baseFilename . '.' . $extension;
			if (Storage::exists($filename))
			{
				$number = 0;
				do {
					$filename = $baseFilename . '-' . ++$number . '.' . $extension;
				} while (Storage::exists($filename));
			}

			// get the mime type
			$mime = $event->uploadedFile->getClientMimeType();

			// save new file to storage
			//Storage::disk('local')->put($filename, File::get($file));
			Storage::put($filename, File::get($event->uploadedFile));

			//$event->imageName     = $name;
			//$event->imageFilename = $filename;
			//$event->imageMime     = $mime;

			//return array('name' => $name, 'filename' => $filename, 'mime' => $mime);

			$event->imageFilename = $filename;
			$publicMessageFile = new \App\PublicMessageFile();
			$publicMessageFile->name     = $name;
			$publicMessageFile->filename = $filename;
			$publicMessageFile->mime     = $mime;
			return $publicMessageFile;
		}

		return false;
	}

}
