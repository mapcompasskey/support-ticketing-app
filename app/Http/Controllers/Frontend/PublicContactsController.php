<?php namespace App\Http\Controllers\Frontend;

use App\PublicContact;
use App\Http\Requests\Request;
use App\Http\Controllers\Controller;

class PublicContactsController extends Controller {

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  string $slug
     * @return Response
     */
    public function destroy($id, $slug)
    {
        $contact = PublicContact::whereId($id)->whereUnsubscribeSlug($slug)->firstOrFail();
        $email = $contact->email;

        $contact->delete();

        return view('frontend.messages.public.delete', compact('email'));
    }

}
