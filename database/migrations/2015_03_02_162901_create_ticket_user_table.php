<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_user', function(Blueprint $table)
		{
			$table->integer('ticket_id')->unsigned()->index();
			$table->foreign('ticket_id')
				->references('id')
				->on('tickets')
				->onDelete('cascade');

			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticket_user');
	}

}
