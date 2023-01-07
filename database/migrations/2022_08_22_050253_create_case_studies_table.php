<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('com_name');
            $table->string('com_image');
            $table->string('description');
            $table->text('summary1');
            $table->string('group_images_1');
            $table->string('group_images_2');
            $table->string('group_images_3');
            $table->string('group_images_4');
            $table->string('group_images_5');
            $table->string('group_images_6');
            $table->string('group_images_7');
            $table->string('img1');
            $table->text('summary2');
            //////////content 1
            $table->longText('content');
            ///////////agency
            $table->string('agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_studies');
    }
}
