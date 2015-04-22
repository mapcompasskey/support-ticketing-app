<?php namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper {

    /**
     * Upload a file and save it in storage.
     *
     * @param UploadedFile $uploadedFile
     * @param string       $directory
     * @return array
     */
    static function upload(UploadedFile $uploadedFile, $directory)
    {
        $extension = $uploadedFile->getClientOriginalExtension();
        if ($extension != '')
        {
            // get the filename
            $filename = $uploadedFile->getClientOriginalName();

            // get the name of the file and the mime type
            $name = substr($filename, 0, strrpos($filename, '.'));
            $mime = $uploadedFile->getClientMimeType();

            // clean up the filename
            $filename = FileHelper::serializeFilename($filename, true);

            // make sure the filename is unique
            $filename = FileHelper::incrementFilename($filename, $directory);

            // the full path to the file
            $filepath = $directory . $filename;

            // save new file to storage
            Storage::put($filepath, File::get($uploadedFile));

            return array(
                'name'     => $name,
                'mime'     => $mime,
                'filename' => $filename
            );
        }
    }

    /**
     * Clean up filenames for storage.
     *
     * @param string $filename
     * @param bool   $timestamp
     * @return string|mixed|string
     */
    static function serializeFilename($filename, $timestamp = false)
    {
        $extension = substr($filename, strrpos($filename, '.'));
        $filename = strtolower($filename);
        $filename = substr($filename, 0, strrpos($filename, '.'));
        $filename = substr($filename, 0, 200);
        $filename = preg_replace('/[ \.\_]+/i', '-', $filename);
        $filename = preg_replace('/[^a-z0-9\-]+/i', '', $filename);
        $filename = $filename . $extension;

        if ($timestamp)
        {
            $filename = date('Y-m-d-') . $filename;
        }

        return $filename;
    }

    /**
     * Increment the filename until it is unique.
     *
     * @param string $filename
     * @param string $directory
     * @return string|string
     */
    static function incrementFilename($filename, $directory)
    {
        $extension = substr($filename, strrpos($filename, '.'));
        $baseFilename = substr($filename, 0, strrpos($filename, '.'));
        $filepath = $directory . $filename;

        if (Storage::exists($filepath))
        {
            $number = 0;
            do
            {
                $filename = $baseFilename . '-' . ++$number . $extension;
                $filepath = $directory . $filename;
            } while (Storage::exists($filepath));
        }

        return $filename;
    }

}