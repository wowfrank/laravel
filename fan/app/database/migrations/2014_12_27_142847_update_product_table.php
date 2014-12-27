<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `suggest_price` `suggest_price` decimal(6,2) NOT NULL DEFAULT '0';");
		DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `retail_lowest` `retail_lowest` decimal(6,2) NOT NULL DEFAULT '0';");
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
