<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostMultisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_multis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pms_user_id');
            $table->string('pms_summary')->nullable();
            $table->text('pms_content')->nullable();
            $table->integer('pms_user_tag_id')->nullable();
            $table->string('pms_location')->nullable();
            $table->string('pms_list_image')->nullable();
            $table->integer('pms_type')->nullable();
            $table->integer('pms_status')->nullable();
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
        Schema::dropIfExists('post_multis');
    }
}
