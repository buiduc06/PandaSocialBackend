<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cate_id');
            $table->string('user_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('image');
            $table->string('list_image');
            $table->integer('active');
            $table->string('room_size')->nullable();
            $table->integer('bed')->nullable();
            $table->integer('max_people')->nullable();
            $table->integer('wifi')->nullable();
            $table->integer('room_service')->nullable();
            $table->integer('breakfast')->nullable();
            $table->integer('laundry')->nullable();
            $table->integer('tax_aiport')->nullable();
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
        Schema::dropIfExists('ticket_products');
    }
}
