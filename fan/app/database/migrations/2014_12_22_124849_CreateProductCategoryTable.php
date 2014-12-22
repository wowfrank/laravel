<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_category', function(Blueprint $table)
		{
			$table->integer('product_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product');
			$table->foreign('category_id')->references('id')->on('category');

			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->primary(array('product_id', 'category_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_category');
	}

}
