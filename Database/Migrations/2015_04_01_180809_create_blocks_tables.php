<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksTables extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('block__blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('block__blocks_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('online')->nullable();
            $table->text('body')->nullable();

            $table->integer('block_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['block_id', 'locale']);
            $table->foreign('block_id')->references('id')->on('block__blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('block__blocks');
        Schema::drop('block__blocks_translations');
    }
}
