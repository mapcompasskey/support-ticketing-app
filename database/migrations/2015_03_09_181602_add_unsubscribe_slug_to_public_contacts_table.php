<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnsubscribeSlugToPublicContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('public_contacts', function(Blueprint $table)
		{
			$table->string('unsubscribe_slug', 10)->after('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('public_contacts', function(Blueprint $table)
		{
			$table->dropColumn('unsubscribe_slug');
		});
	}

}
