<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cname');
			$table->string('ename');
			$table->string('brand');
			$table->string('unit');
			$table->string('suggest_price');
			$table->string('retail_lowest');
			$table->string('gross_weight');
			$table->string('note');
			$table->string('item_no');
			$table->boolean('status');
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->unique(array('cname', 'ename', 'brand', 'unit'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product');
	}

}
