<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('summary', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('topic_id');
            $table->string('location', 100);
            $table->integer('country_id')->nullable();
            $table->integer('creator_id');
            $table->tinyInteger('status')->comment('1: Enable, 2: Diable')->default(2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tribes', function (Blueprint $table) {
            //
            Schema::dropIfExists('tribes');
        });
    }
}
