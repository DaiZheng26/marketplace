<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->default("0");
            $table->integer('group_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('father_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->dateTime('date');
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_phone')->nullable();
            $table->string('to_email')->nullable();
            $table->string('to_name')->nullable();
            $table->string('to_cc')->nullable();
            $table->string('to_bcc')->nullable();
            $table->tinyInteger('status')->default("0");
            $table->tinyInteger('flag')->default("0");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('webmails');
    }
}
