<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGradingEnrolledSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrolled_subjects', function($table) {
            $table->decimal('g1', '8', '2')->nullable();
            $table->decimal('g2', '8', '2')->nullable();
            $table->decimal('g3', '8', '2')->nullable();
            $table->decimal('g4', '8', '2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrolled_subjects', function($table) {
            $table->dropColumn('g1');
            $table->dropColumn('g2');
            $table->dropColumn('g3');
            $table->dropColumn('g4');
        });
    }
}
