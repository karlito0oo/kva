<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('image')->nullable();
            $table->string('middlename')->nullable();
            $table->string('address')->nullable();
            $table->string('contactno')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('gender')->nullable();
            $table->string('civilStatus')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            //guardian
            $table->string('guardianName')->nullable();
            $table->string('guardianContactNo')->nullable();
            $table->string('guardianAddress')->nullable();
            //schools
            $table->string('elementary')->nullable();
            $table->string('elementaryAddress')->nullable();
            $table->string('highschool')->nullable();
            $table->string('highschoolAddress')->nullable();
            $table->string('college')->nullable();
            $table->string('collegeAddress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('image');
            $table->dropColumn('middlename');
            $table->dropColumn('address');
            $table->dropColumn('contactno');
            $table->dropColumn('birthday');
            $table->dropColumn('birthplace');
            $table->dropColumn('gender');
            $table->dropColumn('civilStatus');
            $table->dropColumn('religion');
            $table->dropColumn('nationality');
            $table->dropColumn('guardianName');
            $table->dropColumn('guardianContactNo');
            $table->dropColumn('guardianAddress');

            $table->dropColumn('elementary');
            $table->dropColumn('elementaryAddress');
            $table->dropColumn('highschool');
            $table->dropColumn('highschoolAddress');
            $table->dropColumn('college');
            $table->dropColumn('collegeAddress');
        });
    }
}
