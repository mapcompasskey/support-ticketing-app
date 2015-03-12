<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicMessageFile extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'public_message_id',
		'name',
		'filename',
		'mime'
	];

	/**
	 * A file is owned by a public message.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function publicMessage()
	{
		return $this->belongsTo('App\PublicMessage');
	}

}
