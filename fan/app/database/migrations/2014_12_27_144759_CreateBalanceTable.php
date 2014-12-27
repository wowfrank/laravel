<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('transfered', 6, 2);
			$table->string('tran_screenshot');
			$table->decimal('received', 6, 2);
			$table->string('rece_screenshot');
			$table->string('path');
			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('balance');
	}

}
