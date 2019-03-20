<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyticsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analytics_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id');
            $table->string('ip')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('query')->nullable();
            $table->string('load_time')->nullable();
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
        Schema::dropIfExists('analytics_pages');
    }
}
