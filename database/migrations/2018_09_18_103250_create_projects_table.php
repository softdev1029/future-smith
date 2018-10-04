<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('members');
            $table->integer('topic_id');
            $table->string('location');
            $table->integer('country_id');
            $table->integer('tribe_id');
            $table->integer('creator_id');
            $table->integer('co_chief_id')->nullable();
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
        Schema::table('projects', function (Blueprint $table) {
            //
            Schema::dropIfExists('projects');
        });
    }
}
