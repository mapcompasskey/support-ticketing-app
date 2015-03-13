<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadPublicMessageFileCommand extends Command implements SelfHandling {

	public $publicMessage;
	public $uploadedFile;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($publicMessage, $uploadedFile)
	{
		$this->publicMessage = $publicMessage;
		$this->uploadedFile = $uploadedFile;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$extension = $this->uploadedFile->getClientOriginalExtension();
		if ($extension != '')
		{
			// get the file's name
			$name = $this->uploadedFile->getClientOriginalName();
			//$name = substr($name, 0, strrpos($name, '.'));

			// clean up the filename
			$baseFilename = $this->uploadedFile->getClientOriginalName();
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
			$mime = $this->uploadedFile->getClientMimeType();

			// save new file to storage
			//Storage::disk('local')->put($filename, File::get($file));
			Storage::put($filename, File::get($this->uploadedFile));

			//Event::fire('publicMessageFileWasUploaded', [$this->publicMessage, $name, $filename, $mime]);
			$publicMessageFile = new \App\PublicMessageFile();
			$publicMessageFile->name = $name;
			$publicMessageFile->filename = $filename;
			$publicMessageFile->mime = $mime;
			$this->publicMessage->files()->save($publicMessageFile);
		}

		//dd($this);
	}

}
