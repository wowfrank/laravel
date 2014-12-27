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
		DB::statement("ALTER TABLE `fan`.`balance` CHANGE COLUMN `transfered` `transfered` decimal(8,2) NOT NULL DEFAULT '0';");
		DB::statement("ALTER TABLE `fan`.`balance` CHANGE COLUMN `received` `received` decimal(8,2) NOT NULL DEFAULT '0';");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::statement("ALTER TABLE `fan`.`balance` CHANGE COLUMN `transfered` `transfered` decimal(6,2) NOT NULL DEFAULT '0';");
		DB::statement("ALTER TABLE `fan`.`balance` CHANGE COLUMN `received` `received` decimal(6,2) NOT NULL DEFAULT '0';");
	}

}
