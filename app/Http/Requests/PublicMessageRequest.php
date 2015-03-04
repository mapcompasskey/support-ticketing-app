<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PublicMessageRequest extends Request {

	/**
	 * The key to be used for the view error bag.
	 *
	 * @var string
	 */
	protected $errorBag = 'publicMessage';

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'ticket_id' => 'required|integer',
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		];
	}

	/**
	 * Get the URL to redirect to on a validation error.
	 *
	 * @return string
	 */
	protected function getRedirectUrl()
	{
		$url = $this->redirector->getUrlGenerator();

		return $url->previous() . '#public-message';
	}

	/**
	 * Get the validator instance for the request.
	 *
	 * @param $factory \Illuminate\Validation\Factory
	 * @return \Illuminate\Validation\Validator
	 */
	public function validator(\Illuminate\Validation\Factory $factory)
	{
		// add 'notify' attribute if doesn't exist
		if ( ! $this->request->has('notify'))
		{
			$this->merge(['notify' => 0]);
		}

		return $factory->make($this->all(), $this->rules());
	}

}
