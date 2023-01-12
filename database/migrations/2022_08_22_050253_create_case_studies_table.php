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
            $table->text('slug');
            $table->text('summary1');
            $table->string('group_images');
            $table->string('long_banner')->nullable();
            $table->string('short_banner')->nullable();
            $table->text('summary2');
            $table->longText('content');
            $table->text('our_content_header');
            $table->text('title_1');
            $table->string('image_1');
            $table->text('description_1');
            $table->text('title_2')->nullable();
            $table->string('image_2')->nullable();
            $table->text('description_2')->nullable();
            $table->text('title_3')->nullable();
            $table->string('image_3')->nullable();
            $table->text('description_3')->nullable();
            $table->string('agency')->nullable();
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
