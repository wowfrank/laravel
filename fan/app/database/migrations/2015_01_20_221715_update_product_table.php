<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table->dropColumn('item_no');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product', function(Blueprint $table)
		{
			$table->string('item_no')->nullable()->default(null);
		});
	}

}
