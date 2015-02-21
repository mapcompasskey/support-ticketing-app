<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'organization_id',
		'name',
		'title',
		'email'
	];

	/**
	 * A contact is owned by an organization
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function organization()
	{
		return $this->belongsTo('App\Organization');
	}

	/**
	 * Get the tickets associated with the given contact.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tickets()
	{
		return $this->belongsToMany('App\Ticket');
	}

	/**
	 * A contact can have many public messages.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function publicMessages()
	{
		return $this->hasMany('App\PublicMessage');
	}

	/**
	 * Gets the number of public messages a contact has.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function publicMessagesCount()
	{
		return $this->hasOne('App\PublicMessage')
			->selectRaw('contact_id, count(*) as aggregate')
			->groupBy('contact_id');
	}

}
