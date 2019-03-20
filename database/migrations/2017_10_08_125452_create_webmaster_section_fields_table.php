<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebmasterSectionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmaster_section_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('webmaster_id');
            $table->integer('type');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('default_value')->nullable();
            $table->text('details_ar')->nullable();
            $table->text('details_en')->nullable();
            $table->integer('row_no');
            $table->tinyInteger('status');
            $table->tinyInteger('required');
            $table->string('lang_code')->nullable();
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
        Schema::dropIfExists('webmaster_section_fields');
    }
}
