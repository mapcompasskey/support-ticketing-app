<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicMessage extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'ticket_id',
		'name',
		'title',
		'email',
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
	 * Scope query for getting distinct contacts from messages
	 *
	 * @param $query
	 */
	public function scopeDistinctContacts($query)
	{
		$query->select('ticket_id', 'email')->groupBy('email')->orderBy('created_at', 'asc');
	}

	/**
	 * A message has many files.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function files()
	{
		return $this->hasMany('App\PublicMessageFile');
	}

	/**
	 * A message is owned by a ticket.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ticket()
	{
		return $this->belongsTo('App\Ticket');
	}

}
