<?php
use App\Banner;
use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Banner = new Banner();
        $Banner->row_no = 1;
        $Banner->section_id = 1;
        $Banner->title_ar = "بنر رقم ١";
        $Banner->title_en = "Banner #1";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "noimg.png";
        $Banner->file_en = "noimg.png";
        $Banner->link_url = "#";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();

        $Banner = new Banner();
        $Banner->row_no = 2;
        $Banner->section_id = 1;
        $Banner->title_ar = "بنر رقم ٢";
        $Banner->title_en = "Banner #2";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "noimg.png";
        $Banner->file_en = "noimg.png";
        $Banner->link_url = "#";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();


        $Banner = new Banner();
        $Banner->row_no = 1;
        $Banner->section_id = 2;
        $Banner->title_ar = "تصميم ريسبونسف";
        $Banner->title_en = "Responsive Design";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "";
        $Banner->file_en = "";
        $Banner->link_url = "#";
        $Banner->icon = "fa-object-group";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();

        $Banner = new Banner();
        $Banner->row_no = 2;
        $Banner->section_id = 2;
        $Banner->title_ar = " احدث التقنيات";
        $Banner->title_en = "HTML5 & CSS3";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "";
        $Banner->file_en = "";
        $Banner->link_url = "#";
        $Banner->icon = "fa-html5";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();


        $Banner = new Banner();
        $Banner->row_no = 3;
        $Banner->section_id = 2;
        $Banner->title_ar = "باستخدام بوتستراب";
        $Banner->title_en = "Bootstrap Used";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "";
        $Banner->file_en = "";
        $Banner->link_url = "#";
        $Banner->icon = "fa-code";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();
        

        $Banner = new Banner();
        $Banner->row_no = 4;
        $Banner->section_id = 2;
        $Banner->title_ar = "تصميم كلاسيكي";
        $Banner->title_en = "Classic Design";
        $Banner->details_ar = "هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص.";
        $Banner->details_en = "It is a long established fact that a reader will be distracted by the readable content of a page.";
        $Banner->file_ar = "";
        $Banner->file_en = "";
        $Banner->link_url = "#";
        $Banner->icon = "fa-laptop";
        $Banner->status = 1;
        $Banner->visits = 0;
        $Banner->created_by = 1;
        $Banner->save();
        

    }
}
