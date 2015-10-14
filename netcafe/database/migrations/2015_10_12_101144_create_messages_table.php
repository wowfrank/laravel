<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('msg_content');
            $table->char('msg_ip', 50);
            $table->integer('msg_agreement')->default(0);
            $table->boolean('cafe_service')->nullable()->default(null);
            $table->boolean('cafe_environment')->nullable()->default(null);
            $table->boolean('cafe_hygiene')->nullable()->default(null);
            $table->boolean('cafe_hardware')->nullable()->default(null);
            $table->boolean('cafe_price')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
