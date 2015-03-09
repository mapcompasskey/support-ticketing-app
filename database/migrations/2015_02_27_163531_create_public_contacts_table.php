<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicContacts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public_contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ticket_id')->unsigned();
			$table->string('email');
			$table->string('unsubscribe_slug', 10);
			$table->timestamps();

			$table->foreign('ticket_id')
				->references('id')
				->on('tickets')
				->onDelete('cascade');

			$table->unique(array('ticket_id', 'email'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('public_contacts');
	}

}
