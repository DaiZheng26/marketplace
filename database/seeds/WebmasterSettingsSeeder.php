<?php

use App\WebmasterSetting;
use Illuminate\Database\Seeder;

class WebmasterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Default Webmaster Settings

        $settings = new WebmasterSetting();
        $settings->ar_box_status = true;
        $settings->en_box_status = true;
        $settings->seo_status = true;
        $settings->analytics_status = true;
        $settings->banners_status = true;
        $settings->inbox_status = true;
        $settings->calendar_status = true;
        $settings->settings_status = true;
        $settings->newsletter_status = true;
        $settings->members_status = false;
        $settings->orders_status = false;
        $settings->shop_status = false;
        $settings->shop_settings_status = false;
        $settings->default_currency_id = "0";
        $settings->languages_count = "2";

        $settings->header_menu_id = "1";
        $settings->footer_menu_id = "2";
        $settings->home_banners_section_id = "1";
        $settings->home_text_banners_section_id = "2";
        $settings->side_banners_section_id = "3";
        $settings->contact_page_id = "2";
        $settings->newsletter_contacts_group = "1";
        $settings->new_comments_status = true;
        $settings->home_content1_section_id = "7";
        $settings->home_content2_section_id = "4";
        $settings->home_content3_section_id = "9";
        $settings->latest_news_section_id = "3";
        $settings->links_status = false;
        $settings->register_status = false;
        $settings->permission_group = "3";
        $settings->api_status = false;
        $settings->api_key = rand(000000000000000, 999999999999999);
        $settings->created_by = 1;

        $settings->save();
    }
}
