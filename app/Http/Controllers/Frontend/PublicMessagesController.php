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
        //$message = $this->addNewPublicMessage($ticket, $request, $contactRequest);

        // if there is a file
        if ($request->file('file'))
        {
            $file         = $request->file('file');
            $baseFilename = $file->getClientOriginalName();
            $extension    = $file->getClientOriginalExtension();
            $filename     = $baseFilename . '.' . $extension;
            $number       = 0;

            if (Storage::exists($filename))
            {
                do {
                    $filename = $baseFilename . '-' . ++$number . '.' . $extension;
                }
                while (Storage::exists($filename));
            }

            echo '<pre>' . $file . '</pre>';
            echo '<pre>' . $baseFilename . '</pre>';
            echo '<pre>' . $extension . '</pre>';
            echo '<pre>' . $filename . '</pre>';
            dd($file);
            Storage::disk('local')->put($filename, File::get($file));

            //$publicMessageFile = new PublicMessageFile();
            //$publicMessageFile->name     = $file->getClientOriginalName();
            //$publicMessageFile->filename = $filename;
            //$publicMessageFile->mime     = $file->getClientMimeType();

            //$message->files()->save($publicMessageFile);
        }
        exit;

        return redirect("x/{$ticket->id}/{$ticket->slug}#msg{$message->id}");
    }

}
