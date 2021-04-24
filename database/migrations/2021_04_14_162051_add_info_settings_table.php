<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function($table) {
            $table->longText('aboutSchool')->nullable();
            $table->longText('servicesOffered')->nullable();
            $table->longText('rulesRegulation')->nullable();
            $table->longText('guidelinesInstruction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function($table) {
            $table->dropColumn('aboutSchool');
            $table->dropColumn('servicesOffered');
            $table->dropColumn('rulesRegulation');
            $table->dropColumn('guidelinesInstruction');
        });
    }
}
