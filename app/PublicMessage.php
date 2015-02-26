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
	 * Accessor for the message attribute.
	 *
	 * @param $message
	 * @return string
	 */
	//public function getMessageAttribute($message)
	//{
	//	//$message = str_replace("\r\n", "<br />", $message);
	//	$str = '';
	//	$arr = explode('<br>', nl2br($message, false));
	//	foreach ($arr as $line)
	//	{
	//		$str .= $line . '';
	//	}
	//	return $message;
	//}

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

}
