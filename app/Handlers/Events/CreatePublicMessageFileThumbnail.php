<?php namespace App\Handlers\Events;

use App\Events\PublicMessageFileWasPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        // add '-thumb' suffix to the filename
        //$baseFilename = $event->imageFilename;
        //$position = strrpos($baseFilename, '.');
        //$filename = substr($baseFilename, 0, $position) . '-thumb' . substr($baseFilename, $position);

        // add image to a 'thumb' directory
        $baseFilename = $event->imageFilename;
        $file = 'thumb/' . $baseFilename;

        // save new file to storage
        //Storage::disk('local')->put($filename, File::get($file));
        Storage::put($file, Storage::get($baseFilename));

        $storage_path = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        if (Image::make($storage_path . $file)->resize(100, 100)->save())
        {
            return true;
        }

        return false;
    }

}
