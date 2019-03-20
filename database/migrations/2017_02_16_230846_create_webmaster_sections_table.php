<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebmasterSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmaster_sections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('row_no');
            $table->string('name');
            $table->tinyInteger('type');
            $table->tinyInteger('sections_status');
            $table->tinyInteger('comments_status');
            $table->tinyInteger('date_status');
            $table->tinyInteger('expire_date_status');
            $table->tinyInteger('longtext_status');
            $table->tinyInteger('editor_status');
            $table->tinyInteger('attach_file_status');
            $table->tinyInteger('extra_attach_file_status');
            $table->tinyInteger('multi_images_status');
            $table->tinyInteger('section_icon_status');
            $table->tinyInteger('icon_status');
            $table->tinyInteger('maps_status');
            $table->tinyInteger('order_status');
            $table->tinyInteger('related_status');
            $table->tinyInteger('status');
            $table->string('seo_title_ar')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_description_ar')->nullable();
            $table->string('seo_description_en')->nullable();
            $table->string('seo_keywords_ar')->nullable();
            $table->string('seo_keywords_en')->nullable();
            $table->string('seo_url_slug_ar')->nullable();
            $table->string('seo_url_slug_en')->nullable();
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
        Schema::dropIfExists('webmaster_sections');
    }
}
