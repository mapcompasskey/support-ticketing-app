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
	 * Accessor for returning the preview thumbnail based on the file type.
	 *
	 * @return string
	 */
	public function getPreviewAttribute()
	{
		if ($this->filetype == 'image')
		{
			return '<img src="/files/' . $this->filename . '" width="100px;" />';
		}

		return '<span class="glyphicon glyphicon-file" style="font-size:50px;"></span>';
	}

	/**
	 * Accessor for returning the file type based on the mime.
	 *
	 * @return string
	 */
	public function getFiletypeAttribute()
	{
		$mime = explode('/', $this->attributes['mime']);
		return $mime[0];
	}

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
