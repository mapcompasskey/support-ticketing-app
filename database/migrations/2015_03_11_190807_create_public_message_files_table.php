<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicMessageFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('public_message_files', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('public_message_id')->unsigned();
			$table->string('name');
			$table->string('filename');
			$table->string('mime');
			$table->timestamps();

			$table->foreign('public_message_id')
				->references('id')
				->on('public_messages')
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
		Schema::drop('public_message_files');
	}

}
