<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ticket_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('contact_id')->unsigned();
			$table->text('message');
			$table->timestamps();

			$table->foreign('ticket_id')
				->references('id')
				->on('tickets')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('public_messages');
	}

}
