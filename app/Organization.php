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

	/**
	 * Gets the number of tickets an organization has.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function ticketsCount()
	{
		return $this->hasOne('App\Ticket')
			->selectRaw('organization_id, count(*) as aggregate')
			->groupBy('organization_id');
	}

	/**
	 * An organization can have many contacts.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function contacts()
	{
		return $this->hasMany('App\Contact');
	}

}
