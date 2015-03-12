<?php namespace App\Http\Controllers\Frontend;

use App\PublicMessageFile;
use App\Ticket;
use App\Http\Requests\PublicMessageRequest;
use App\Http\Requests\PublicContactRequest;
use App\Http\Controllers\PublicMessagesController as BaseController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PublicMessagesController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @param PublicMessageRequest $request
     * @param PublicContactRequest $contactRequest
     * @return Response
     */
    public function store(PublicMessageRequest $request, PublicContactRequest $contactRequest)
    {
        // get ticket
        $ticket = Ticket::whereId($request['ticket_id'])->whereSlug($request['ticket_slug'])->firstOrFail();

        // add new message
        $message = $this->addNewPublicMessage($ticket, $request, $contactRequest);

        // if a file was uploaded
        if ($request->file('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            if ($extension != '')
            {
                // get the file's name
                $name = $file->getClientOriginalName();
                //$name = substr($name, 0, strrpos($name, '.'));

                // clean up the filename
                $baseFilename = $file->getClientOriginalName();
                $baseFilename = strtolower($baseFilename);
                $baseFilename = substr($baseFilename, 0, strrpos($baseFilename, '.'));
                $baseFilename = substr($baseFilename, 0, 200);
                $baseFilename = preg_replace('/[ \.\_]+/i', '-',$baseFilename);
                $baseFilename = preg_replace('/[^a-z0-9\-]+/i', '',$baseFilename);
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

                // save new file to storage
                //Storage::disk('local')->put($filename, File::get($file));
                Storage::put($filename, File::get($file));

                // save new file to database
                $publicMessageFile = new PublicMessageFile();
                $publicMessageFile->name = $name;
                $publicMessageFile->filename = $filename;
                $publicMessageFile->mime = $file->getClientMimeType();
                $message->files()->save($publicMessageFile);
            }
        }

        return redirect("x/{$ticket->id}/{$ticket->slug}#msg{$message->id}");
    }

}
