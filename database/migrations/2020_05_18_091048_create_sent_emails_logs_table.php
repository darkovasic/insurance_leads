<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentEmailsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sent_emails_log')) { return; }

        Schema::create('sent_emails_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_id')->length(80);
            $table->integer('user_id')->length(11);
            $table->integer('lead_id')->length(11);
            $table->enum('type', ['er', 'scb']);
            $table->enum('status', ['waiting', 'sent', 'error']);
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
