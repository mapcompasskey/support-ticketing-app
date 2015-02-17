<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

	/**
	 * The attributes that are mass assignable.
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

	/**
	 * An organization can have many tickets.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tickets()
	{
		return $this->hasMany('App\Ticket');
	}

}
