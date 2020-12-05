<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('broker_name', 255);
            $table->string('speed_dial', 20);
            $table->string('preferred_comm_service', 255);
            $table->string('contact_first_name', 50);
            $table->string('contact_last_name', 50);
            $table->string('phone', 20);
            $table->string('email', 255)->unique();
            $table->text('states_covered')->nullable();
            $table->unsignedSmallInteger('min_number_of_trucks')->nullable();
            $table->unsignedSmallInteger('max_number_of_trucks')->nullable();
            $table->text('accepted_languages')->nullable();
            $table->unsignedSmallInteger('daily_max_number_of_leads')->nullable();
            $table->string('working_hours', 255)->nullable();
            $table->unsignedSmallInteger('min_years_of_experience')->nullable();
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
        //
    }
}
