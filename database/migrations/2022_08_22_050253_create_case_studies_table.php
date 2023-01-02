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
            $table->text('summary1');
            $table->string('group_images');
            $table->string('img1');
            $table->text('summary2');
            //////////content 1
            $table->text('first_content');
            ////////////content 2
            $table->text('case_con_2_title_1');
            $table->text('case_con_2_des_1');
            $table->text('case_con_2_title_2');          
            $table->text('case_con_2_des_2');
            $table->text('case_con_2_title_3');
            $table->text('case_con_2_des_3');
            $table->string('case_con_2_img_1');
            $table->string('case_con_2_img_2');
            $table->string('case_con_2_img_3');
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
