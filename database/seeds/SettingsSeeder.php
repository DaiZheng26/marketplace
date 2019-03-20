<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Default Site Settings

        $settings = new Setting();
        $settings->site_title_ar = "اسم الموقع";
        $settings->site_title_en = "Site Title";
        $settings->site_desc_ar = "وصف الموقع الإلكتروني ونبذة قصيره عنه";
        $settings->site_desc_en = "Website description and some little information about it";
        $settings->site_keywords_ar = "كلمات، دلالية، موقع، موقع إلكتروني";
        $settings->site_keywords_en = "key, words, website, web";
        $settings->site_webmails = "info@sitename.com";
        $settings->notify_messages_status = "1";
        $settings->notify_comments_status = "1";
        $settings->notify_orders_status = "1";
        $settings->site_url = "http://www.sitename.com/";
        $settings->site_status = "1";
        $settings->close_msg = "Website under maintenance \n<h1>Comming SOON</h1>";
        $settings->social_link1 = "#";
        $settings->social_link2 = "#";
        $settings->social_link3 = "#";
        $settings->social_link4 = "#";
        $settings->social_link5 = "#";
        $settings->social_link6 = "#";
        $settings->social_link7 = "#";
        $settings->social_link8 = "#";
        $settings->social_link9 = "#";
        $settings->social_link10 = "#";
        $settings->contact_t1_ar = "المبني - اسم الشارع - المدينة - الدولة";
        $settings->contact_t1_en = "Building, Street name, City, Country";
        $settings->contact_t3 = "+(xxx) 0xxxxxxx";
        $settings->contact_t4 = "+(xxx) 0xxxxxxx";
        $settings->contact_t5 = "+(xxx) 0xxxxxxx";
        $settings->contact_t6 = "info@sitename.com";
        $settings->contact_t7_ar = "من الأحد إلى الخميس 08:00 ص - 05:00 م";
        $settings->contact_t7_en = "Sunday to Thursday 08:00 AM to 05:00 PM";

        $settings->style_color1 = "#0cbaa4";
        $settings->style_color2 = "#2e3e4e";
        $settings->style_type = "0";
        $settings->style_bg_type = "0";
        $settings->style_subscribe = "1";
        $settings->style_footer = "1";
        $settings->style_preload = "0";
        $settings->created_by = 1;

        $settings->save();
    }
}