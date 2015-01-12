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
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `description` `description` varchar(255) DEFAULT null;");
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `suggest_price` `suggest_price` decimal(8,2) DEFAULT '0';");
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `retail_lowest` `retail_lowest` decimal(8,2) DEFAULT '0';");
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `gross_weight` `gross_weight` decimal(8,2) DEFAULT '0';");
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `note` `note` varchar(255) DEFAULT null;");
			DB::statement("ALTER TABLE `fan`.`product` CHANGE COLUMN `item_no` `item_no` varchar(255) DEFAULT null;");
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
			
		});
	}

}
