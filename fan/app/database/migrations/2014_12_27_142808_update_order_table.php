<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::statement("ALTER TABLE `fan`.`order` CHANGE COLUMN `sum` `sum` decimal(6,2) NOT NULL DEFAULT '0';");
		DB::statement("ALTER TABLE `fan`.`order` CHANGE COLUMN `labor` `labor` decimal(6,2) NOT NULL DEFAULT '0';");
		DB::statement("ALTER TABLE `fan`.`order` CHANGE COLUMN `transport` `transport` decimal(6,2) NOT NULL DEFAULT '0';");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
