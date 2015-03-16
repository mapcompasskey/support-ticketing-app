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
	 * The directory where these files are stored.
	 *
	 * @var array
	 */
	public $directory = 'messages/public/';

	/**
	 * Accessor for returning the preview thumbnail based on the file type.
	 *
	 * @return string
	 */
	public function getPreviewAttribute()
	{
		if ($this->filetype == 'image')
		{
			return '<img src="/images/' . $this->filepath . '" />';
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
	 * Check whether the file is an image.
	 *
	 * @return boolean
	 */
	public function isImage()
	{
		return ($this->filetype == 'image' ? true : false);
	}

	/**
	 * Accessor for returning the directory and filename.
	 *
	 * @return string
	 */
	public function getFilepathAttribute()
	{
		return $this->directory . $this->filename;
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
