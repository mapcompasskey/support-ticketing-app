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
			$filepath = 'messages/public/' . $filename;
			if (Storage::exists($filepath))
			{
				$number = 0;
				do {
					$filename = $baseFilename . '-' . ++$number . '.' . $extension;
					$filepath = 'messages/public/' . $filename;
				} while (Storage::exists($filepath));
			}

			// get the mime type
			$mime = $event->uploadedFile->getClientMimeType();

			// save new file to storage
			Storage::put($filepath, File::get($event->uploadedFile));

			// update the eloquent model
			$event->publicMessageFile->name     = $name;
			$event->publicMessageFile->filename = $filename;
			$event->publicMessageFile->mime     = $mime;
		}
	}

}
