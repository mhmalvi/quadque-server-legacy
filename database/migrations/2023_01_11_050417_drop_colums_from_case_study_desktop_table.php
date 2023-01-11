<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumsFromCaseStudyDesktopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_study_desktops', function (Blueprint $table) {
            $table->dropColumn('group_images_2');
            $table->dropColumn('group_images_3');
            $table->dropColumn('group_images_4');
            $table->dropColumn('group_images_5');
            $table->dropColumn('group_images_6');
            $table->dropColumn('group_images_7');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('case_study_desktops', function (Blueprint $table) {
            $table->dropColumn('group_images_2');
            $table->dropColumn('group_images_3');
            $table->dropColumn('group_images_4');
            $table->dropColumn('group_images_5');
            $table->dropColumn('group_images_6');
            $table->dropColumn('group_images_7');
        });
    }
}
