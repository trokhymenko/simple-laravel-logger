<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->string('url');
            $table->string('method');
            $table->integer('status_code');
            $table->string('controller');
            $table->string('action');
            $table->string('models');
            $table->string('duration');
            $table->longText('payload');
            $table->longText('payload_raw')->nullable();
            $table->longText('response');
            $table->longText('response_headers');
            $table->text('headers')->nullable();
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
        Schema::dropIfExists('logs');
    }
}
