<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model {

	// mass-assignable attributes
	protected $fillable = [
		'name',
		'description'
	];

}
