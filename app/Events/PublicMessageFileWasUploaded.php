<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PublicMessageFileWasUploaded extends Event {

	use SerializesModels;

	public $uploadedFile;
	public $publicMessageFile;

	/**
	 * Create a new event instance.
	 *
	 * @params $uploadedFile
	 * @return void
	 */
	public function __construct($uploadedFile, $publicMessageFile)
	{
		$this->uploadedFile = $uploadedFile;
		$this->publicMessageFile = $publicMessageFile;
	}

}
