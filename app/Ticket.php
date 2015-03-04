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
	 * Get a list of user ids associated with the current ticket.
	 * Called when the user_list attribute is requested on the Ticket model.
	 *
	 * @return array
	 */
	/*public function getUserListAttribute()
	{
		return $this->users->lists('id');
	}*/

	/**
	 * Set the closed_at attribute.
	 * Called when the closed_at attribute is set on the Ticket model.
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

	/**
	 * A ticket can have many private messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function privateMessages()
	{
		return $this->hasMany('App\PrivateMessage')->orderByCreated();
	}

	/**
	 * Gets the number of private message a ticket has.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function privateMessagesCount()
	{
		return $this->hasOne('App\PrivateMessage')
			->selectRaw('ticket_id, count(*) as aggregate')
			->groupBy('ticket_id');
	}

	/**
	 * A ticket can have many public messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function publicMessages()
	{
		return $this->hasMany('App\PublicMessage')->orderByCreated();
	}

	/**
	 * A ticket can have many contacts from public messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function publicMessagesContacts()
	{
		return $this->hasMany('App\PublicMessage')->distinctContacts();
	}

	/**
	 * Gets the number of public messages a ticket has.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function publicMessagesCount()
	{
		return $this->hasOne('App\PublicMessage')
			->selectRaw('ticket_id, count(*) as aggregate')
			->groupBy('ticket_id');
	}

	/**
	 * A ticket can have many public contacts.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function publicContacts()
	{
		return $this->hasMany('App\PublicContact')->orderByCreated();
	}

	/**
	 * Get the users associated with the given ticket.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	/*public function users()
	{
		return $this->belongsToMany('App\User')->withTimestamps();
	}*/

}
