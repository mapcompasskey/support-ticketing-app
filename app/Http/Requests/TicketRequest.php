<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TicketRequest extends Request {

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

		// add 'notify' attribute if doesn't exist
		if ( ! $this->request->has('notify'))
		{
			$this->merge(['notify' => 0]);
		}

		return $factory->make($this->all(), $this->rules());
	}

}
