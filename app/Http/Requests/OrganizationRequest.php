<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrganizationRequest extends Request {

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
			'name' => 'required',
			'description' => 'required'
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

}
