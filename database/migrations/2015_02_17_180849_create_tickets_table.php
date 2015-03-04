<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('organization_id')->unsigned();
			$table->string('name');
			$table->string('slug', 10);
			$table->text('description');
			$table->timestamp('closed_at');
			$table->timestamps();

			$table->foreign('organization_id')
				->references('id')
				->on('organizations')
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
		Schema::drop('tickets');
	}

}
