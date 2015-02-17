<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

	/**
	 * Attributes that can be mass-assigned
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description'
	];

	/**
	 * Scope query for ordering organizations by id
	 *
	 * @param $query
	 */
	public function scopeOrderById($query)
	{
		$query->orderBy('id', 'desc');
	}

}
