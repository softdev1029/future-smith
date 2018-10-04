<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeRefIdToMessengerThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messenger_threads', function (Blueprint $table) {
            //
            $table->tinyInteger('type')
                  ->comment('1: Global, 2: Tribe, 3: Project')
                  ->default(1)
                  ->after('subject');

            $table->integer('ref_id')
                  ->nullable()
                  ->after('type');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messenger_threads', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->dropColumn('ref_id');
        });
    }
}
