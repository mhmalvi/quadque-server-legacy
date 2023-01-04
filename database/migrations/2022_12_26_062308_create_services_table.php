<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('service_name');
            $table->string('file');
            $table->text('description');
            $table->text('identity_design_title');
            $table->text('identity_design_des');
            $table->string('identity_design_menus_1');
            $table->string('identity_design_menus_2');
            $table->string('identity_design_menus_3');
            $table->string('identity_design_menus_4');
            $table->string('identity_design_menus_5');
            $table->string('identity_design_menus_6');
            $table->integer('project_count');
            $table->integer('happy_clients');

            $table->text('best_service_title');
            $table->text('best_service_header');
            $table->string('best_service_img');
            $table->text('best_service_des');

            $table->text('why_choose_us_title');
            $table->string('why_choose_us_img');
            $table->text('why_choose_us_des');

            $table->text('services_capabilities_title');
            $table->text('services_capabilities_des');
            $table->text('services_capabilities_menus_1');
            $table->text('services_capabilities_menus_2');
            $table->text('services_capabilities_menus_3');
            $table->text('services_capabilities_menus_4');
            $table->text('services_capabilities_menus_5');
            $table->text('services_capabilities_menus_6');
            $table->text('services_capabilities_menus_7');

            $table->text('service_deliver_title');
            $table->text('service_deliver_des');

            $table->text('our_latest_work_title');
            $table->text('our_latest_work_image');

            $table->text('about_us_title');
            $table->text('about_us_name');
            $table->text('about_us_des');
            $table->string('about_us_img');
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
        Schema::dropIfExists('services');
    }
}
