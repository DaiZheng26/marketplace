<?php
use App\WebmasterBanner;
use Illuminate\Database\Seeder;

class WebmasterBannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Home Banners Settings
        $settings = new WebmasterBanner();
        $settings->row_no = 1;
        $settings->name = "homeBanners";
        $settings->width = 1600;
        $settings->height = 500;
        $settings->desc_status = 1;
        $settings->link_status = 1;
        $settings->icon_status = 0;
        $settings->type = 1;
        $settings->status = 1;
        $settings->created_by = 1;
        $settings->save();


        //  Text Banners Settings
        $settings = new WebmasterBanner();
        $settings->row_no = 2;
        $settings->name = "textBanners";
        $settings->width = 330;
        $settings->height = 330;
        $settings->desc_status = 1;
        $settings->link_status = 1;
        $settings->icon_status = 1;
        $settings->type = 0;
        $settings->status = 1;
        $settings->created_by = 1;
        $settings->save();

        //  Side Banners Settings
        $settings = new WebmasterBanner();
        $settings->row_no = 3;
        $settings->name = "sideBanners";
        $settings->width = 330;
        $settings->height = 330;
        $settings->desc_status = 0;
        $settings->link_status = 1;
        $settings->icon_status = 0;
        $settings->type = 1;
        $settings->status = 1;
        $settings->created_by = 1;
        $settings->save();

    }
}
