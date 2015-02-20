<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('organization_id')->unsigned();
			$table->string('name');
			$table->string('title');
			$table->string('email');
			$table->timestamps();

			$table->foreign('organization_id')
				->references('id')
				->on('organizations')
				->onDelete('cascade');
		});

		Schema::create('contact_ticket', function(Blueprint $table)
		{
			$table->integer('contact_id')->unsigned()->index();
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');

			$table->integer('ticket_id')->unsigned()->index();
			$table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

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
		Schema::drop('contacts');
		Schema::drop('contact_ticket');
	}

}
