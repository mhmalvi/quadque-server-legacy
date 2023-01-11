<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGroupImages1ColumsFromCaseStudyDesktopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_study_desktops', function (Blueprint $table) {
            $table->renameColumn('group_images_1', 'group_images');
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
            $table->renameColumn('group_images_1', 'group_images');
        });
    }
}
