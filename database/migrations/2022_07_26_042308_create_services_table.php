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
            $table->longText('identity_design_des');
            $table->integer('project_count');
            $table->integer('happy_clients');
            $table->longText('content');

            $table->text('services_capabilities_menu');

            $table->text('service_deliver_title');
            $table->text('service_deliver_des');

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
