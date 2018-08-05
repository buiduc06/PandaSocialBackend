<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionWithPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_with_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('awp_post_id')->nullable();
            $table->integer('awp_like')->default(0);
            $table->integer('awp_share')->default(0);
            $table->integer('awp_comment')->default(0);
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
        Schema::dropIfExists('action_with_posts');
    }
}
