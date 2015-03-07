<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TicketRequest extends Request {

	/**
	 * The hash tag to use when redirecting with errors.
	 *
	 * @var string
	 */
	protected $hashtag = '#form-errors';

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
			'organization_id' => 'required|integer',
			'name' => 'required',
			'description' => 'required',
			'user_list' => 'array'
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

		return $url->previous() . $this->hashtag;
	}

	/**
	 * Get the validator instance for the request.
	 *
	 * @param $factory \Illuminate\Validation\Factory
	 * @return \Illuminate\Validation\Validator
	 */
	public function validator(\Illuminate\Validation\Factory $factory)
	{
		// add 'user_list' attribute if doesn't exist
		if ( ! $this->request->has('user_list'))
		{
			$this->merge(['user_list' => []]);
		}

		return $factory->make($this->all(), $this->rules());
	}

}
