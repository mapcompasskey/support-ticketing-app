<?php namespace App\Handlers\Events;

use App\Events\PublicMessageFileWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Intervention\Image\Facades\Image;

class CreatePublicMessageFileThumbnail {

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
        if ($event->publicMessageFile->toArray())
        {
            if ($event->publicMessageFile->isImage())
            {
                $storage_file = storage_path() . '/app/messages/public/' . $event->publicMessageFile->filename;
                if (file_exists($storage_file))
                {
                    // take the image in storage, resize it and save it to the public directory
                    $public_file = public_path() . '/images/messages/public/' . $event->publicMessageFile->filename;
                    Image::make($storage_file)->fit(100, 100)->save($public_file);
                }
            }
        }

    }

}
