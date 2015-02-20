<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicMessage extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'contact_id',
		'ticket_id',
		'message'
	];

	/**
	 * Scope query for ordering messages by created_at
	 *
	 * @param $query
	 */
	public function scopeOrderByCreated($query)
	{
		$query->orderBy('created_at', 'asc');
	}

	/**
	 * A message is owned by a ticket
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ticket()
	{
		return $this->belongsTo('App\Ticket');
	}

	/**
	 * A message is owned by a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * A message is owned by a contact
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function contact()
	{
		return $this->belongsTo('App\Contact');
	}

}
