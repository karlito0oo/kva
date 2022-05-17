<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeesGrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('levels', function($table) {
            $table->decimal('registration', '8', '2')->nullable();
            $table->decimal('tuition', '8', '2')->nullable();
            $table->decimal('insurance', '8', '2')->nullable();
            $table->decimal('library', '8', '2')->nullable();
            $table->decimal('science', '8', '2')->nullable();
            $table->decimal('computer', '8', '2')->nullable();
            $table->decimal('athletics', '8', '2')->nullable();
            $table->decimal('misc', '8', '2')->nullable();
            $table->decimal('books', '8', '2')->nullable();
            $table->decimal('school_uniform', '8', '2')->nullable();
            $table->decimal('pe_uniform', '8', '2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('levels', function($table) {
            $table->dropColumn('registration');
            $table->dropColumn('tuition');
            $table->dropColumn('insurance');
            $table->dropColumn('library');
            $table->dropColumn('science');
            $table->dropColumn('computer');
            $table->dropColumn('athletics');
            $table->dropColumn('misc');
            $table->dropColumn('books');
            $table->dropColumn('school_uniform');
            $table->dropColumn('pe_uniform');
        });
    }
}
