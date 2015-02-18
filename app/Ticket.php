<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'organization_id',
		'name',
		'slug',
		'description',
		'closed_at'
	];

	/**
	 * Additional fields to treat as Carbon instances
	 *
	 * @var array
	 */
	protected $dates = ['closed_at'];

	/**
	 * Set the closed_at attribute.
	 *
	 * @param $date
	 */
	public function setClosedAtAttribute($date)
	{
		$this->attributes['closed_at'] = Carbon::parse($date);
	}

	/**
	 * Scope query for ordering tickets by updated_at
	 *
	 * @param $query
	 */
	public function scopeOrderByUpdated($query)
	{
		$query->orderBy('updated_at', 'desc');
	}

	/**
	 * A ticket is owned by an organization
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function organization()
	{
		return $this->belongsTo('App\Organization');
	}

}
