<?php namespace App\Services;

use App\Http\Requests\Request;
use App\PublicContact;
use Validator;
use Illuminate\Contracts\Validation\ValidationException;

class CreatePublicContact {

    public function store($request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
        {
            dd($validator->messages()->toArray());
        }

        dd('its good');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $data
     */
    /*public function store(array $data)
    {
        $validator = $this->validator($data);

        if ($validator->fails())
        {
            //dd($validator->messages()->toArray());
            //return redirect()->back()->withErrors($validator->errors(), 'publicMessage');
            throw new ValidationException($validator->errors());

            //$exception = new ValidationFailureException('Validation Failed.');
            //$exception->setErrors($validator->errors())->setInput($data);
            //throw $exception;


            //dd('could not add new public contact');
            //$this->throwValidationException($request, $validator);
            //throw new ValidationException($validator);
            //throw new HttpResponseException($this->response(
            //    $this->formatErrors($validator)
            //));
        }

        //$contact = \App\PublicContact::ticketIdAndEmail($data)->get();
        //if ($contact->isEmpty())
        //{
        //    echo 'create new contact';
        //    //$this->create($data);
        //}
        //dd($contact);

        //return redirect($this->redirectPath());
    }*/

    /**
     * Get a validator for a PublicContact request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'ticket_id' => 'required|integer',
            'emailo' => 'required|email'
        ]);
    }

    /**
     * Create a new PublicContact instance.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data)
    {
        return PublicContact::create([
            'ticket_id' => $data['ticket_id'],
            'email' => $data['email']
        ]);
    }

}
