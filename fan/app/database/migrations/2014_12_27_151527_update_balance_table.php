<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBalanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('balance', function($table)
        {
                $table->string('tran_date');
                $table->string('rece_date');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('balance', function($table)
        {
                $table->drop_column('tran_date');
                $table->drop_column('rece_date');
        });
	}

}
