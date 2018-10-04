<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('charcode', 2)->unique();
            $table->string('charcode3', 3);
            $table->string('numcode', 3);
            $table->string('name', 64)->unique();
            $table->string('country_code', 10);
            $table->string('region', 50);
            $table->string('sub_region', 100)->nullable();
            $table->softDeletes();
            $table->index(['charcode','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
