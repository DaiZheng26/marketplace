<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebmasterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmaster_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('ar_box_status');
            $table->tinyInteger('en_box_status');
            $table->tinyInteger('seo_status');
            $table->tinyInteger('analytics_status');
            $table->tinyInteger('banners_status');
            $table->tinyInteger('inbox_status');
            $table->tinyInteger('calendar_status');
            $table->tinyInteger('settings_status');
            $table->tinyInteger('newsletter_status');
            $table->tinyInteger('members_status');
            $table->tinyInteger('orders_status');
            $table->tinyInteger('shop_status');
            $table->tinyInteger('shop_settings_status');
            $table->integer('default_currency_id');
            $table->integer('languages_count');
            $table->integer('latest_news_section_id');
            $table->integer('header_menu_id');
            $table->integer('footer_menu_id');
            $table->integer('home_banners_section_id');
            $table->integer('home_text_banners_section_id');
            $table->integer('side_banners_section_id');
            $table->integer('contact_page_id');
            $table->integer('newsletter_contacts_group');
            $table->tinyInteger('new_comments_status');
            $table->tinyInteger('links_status');
            $table->tinyInteger('register_status');
            $table->integer('permission_group');
            $table->tinyInteger('api_status');
            $table->string('api_key');
            $table->integer('home_content1_section_id');
            $table->integer('home_content2_section_id');
            $table->integer('home_content3_section_id');
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
        Schema::dropIfExists('webmaster_settings');
    }
}
