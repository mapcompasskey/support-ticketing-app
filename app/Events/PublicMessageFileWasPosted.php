<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PublicMessageFileWasPosted extends Event {

	use SerializesModels;

	public $uploadedFile;
	public $imageName;
	public $imageFilename;
	public $imageMime;

	/**
	 * Create a new event instance.
	 *
	 * @params $uploadedFile
	 * @return void
	 */
	public function __construct($uploadedFile)
	{
		$this->uploadedFile = $uploadedFile;
	}

}
