<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tweet_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tweet_user_id');
            $table->string('comment');
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
        Schema::dropIfExists('tweet_comments');
    }
}
