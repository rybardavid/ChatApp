<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReugularConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reugular_conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('friendship_id')->unsigned();
            $table->foreign('friendship_id')->references('id')->on('friendships')->onDelete('cascade');
            $table->string('name')->nullable($value = true);
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
        Schema::dropIfExists('reugular_conversations');
    }
}
