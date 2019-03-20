<?php

use App\Topic;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // About
        $Topic = new Topic();
        $Topic->row_no = 1;
        $Topic->webmaster_id = 1;
        $Topic->title_ar = "من نحن";
        $Topic->title_en = "About Us";
        $Topic->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Topic->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Topic->date = date('Y-m-d');
        $Topic->status = 1;
        $Topic->visits = 0;
        $Topic->section_id = 0;
        $Topic->created_by = 1;
        $Topic->save();


        // Contact
        $Topic = new Topic();
        $Topic->row_no = 2;
        $Topic->webmaster_id = 1;
        $Topic->title_ar = "اتصل بنا";
        $Topic->title_en = "Contact Us";
        $Topic->details_ar ="";
        $Topic->details_en = "";
        $Topic->date = date('Y-m-d');
        $Topic->status = 1;
        $Topic->visits = 0;
        $Topic->section_id = 0;
        $Topic->created_by = 1;
        $Topic->save();

        // Privacy
        $Topic = new Topic();
        $Topic->row_no = 3;
        $Topic->webmaster_id = 1;
        $Topic->title_ar = "الخصوصية";
        $Topic->title_en = "Privacy";
        $Topic->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Topic->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Topic->date = date('Y-m-d');
        $Topic->status = 1;
        $Topic->visits = 0;
        $Topic->section_id = 0;
        $Topic->created_by = 1;
        $Topic->save();

        // Terms
        $Topic = new Topic();
        $Topic->row_no = 4;
        $Topic->webmaster_id = 1;
        $Topic->title_ar = "الشروط والأحكام";
        $Topic->title_en = "Terms & Conditions";
        $Topic->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Topic->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Topic->date = date('Y-m-d');
        $Topic->status = 1;
        $Topic->visits = 0;
        $Topic->section_id = 0;
        $Topic->created_by = 1;
        $Topic->save();

    }
}
