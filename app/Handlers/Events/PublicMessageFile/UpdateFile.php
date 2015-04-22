<?php namespace App\Handlers\Events\PublicMessageFile;

use App\Events\PublicMessageFileWasUploaded;
use App\Helpers\FileHelper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UpdateFile {

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
     * @param  PublicMessageFileWasUploaded $event
     * @return void
     */
    public function handle(PublicMessageFileWasUploaded $event)
    {
        // update the file
        $uploadedFile = $event->uploadedFile;
        $directory = $event->publicMessageFile->directory;
        $file = FileHelper::upload($uploadedFile, $directory);

        // update the eloquent model
        $event->publicMessageFile->fill($file);
    }

}
