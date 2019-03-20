<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticsVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('full_address')->nullable();
            $table->string('location_cor1')->nullable();
            $table->string('location_cor2')->nullable();
            $table->string('os')->nullable();
            $table->string('browser')->nullable();
            $table->string('resolution')->nullable();
            $table->string('referrer')->nullable();
            $table->string('hostname')->nullable();
            $table->string('org')->nullable();
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('analytics_visitors');
    }
}
