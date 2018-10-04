<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('discussions', function (Blueprint $table) {
          $table->renameColumn('type', 'discussionable_type');
          $table->renameColumn('ref_id', 'discussionable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('discussions', function (Blueprint $table) {
          $table->renameColumn('discussionable_type', 'type');
          $table->renameColumn('discussionable_id', 'ref_id');
        });
    }
}
