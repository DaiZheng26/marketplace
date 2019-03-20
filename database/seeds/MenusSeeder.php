<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Main Menu
        $Menu1 = new Menu();
        $Menu1->row_no = 1;
        $Menu1->father_id = 0;
        $Menu1->title_ar = "القائمة الرئيسية";
        $Menu1->title_en = "Main Menu";
        $Menu1->status = 1;
        $Menu1->type = 0;
        $Menu1->cat_id = 0;
        $Menu1->link = "";
        $Menu1->created_by = 1;
        $Menu1->save();

        // Footer Menu
        $Menu2 = new Menu();
        $Menu2->row_no = 2;
        $Menu2->father_id = 0;
        $Menu2->title_ar = "روابط سريعة";
        $Menu2->title_en = "Quick Links";
        $Menu2->status = 1;
        $Menu2->type = 0;
        $Menu2->cat_id = 0;
        $Menu2->link = "";
        $Menu2->created_by = 1;
        $Menu2->save();

        // Home
        $Menu = new Menu();
        $Menu->row_no = 1;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "الرئيسية";
        $Menu->title_en = "Home";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "home";
        $Menu->created_by = 1;
        $Menu->save();
        // About
        $Menu = new Menu();
        $Menu->row_no = 2;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "من نحن";
        $Menu->title_en = "About";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "topic/about";
        $Menu->created_by = 1;
        $Menu->save();
        // Services
        $Menu = new Menu();
        $Menu->row_no = 3;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "خدماتنا";
        $Menu->title_en = "Services";
        $Menu->status = 1;
        $Menu->type = 3;
        $Menu->cat_id = 2;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // News
        $Menu = new Menu();
        $Menu->row_no = 4;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "أخبارنا";
        $Menu->title_en = "News";
        $Menu->status = 1;
        $Menu->type = 2;
        $Menu->cat_id = 3;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Photos
        $Menu = new Menu();
        $Menu->row_no = 5;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "الصور";
        $Menu->title_en = "Photos";
        $Menu->status = 1;
        $Menu->type = 2;
        $Menu->cat_id = 4;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Videos
        $Menu = new Menu();
        $Menu->row_no = 6;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "الفيديو";
        $Menu->title_en = "Videos";
        $Menu->status = 1;
        $Menu->type = 3;
        $Menu->cat_id = 5;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Audio
        $Menu = new Menu();
        $Menu->row_no = 7;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "الصوتيات";
        $Menu->title_en = "Audio";
        $Menu->status = 1;
        $Menu->type = 3;
        $Menu->cat_id = 6;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Products
        $Menu = new Menu();
        $Menu->row_no = 8;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "المنتجات";
        $Menu->title_en = "Products";
        $Menu->status = 1;
        $Menu->type = 3;
        $Menu->cat_id = 8;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Blog
        $Menu = new Menu();
        $Menu->row_no = 9;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "المدونة";
        $Menu->title_en = "Blog";
        $Menu->status = 1;
        $Menu->type = 2;
        $Menu->cat_id = 7;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Contact
        $Menu = new Menu();
        $Menu->row_no = 10;
        $Menu->father_id = $Menu1->id;
        $Menu->title_ar = "اتصل بنا";
        $Menu->title_en = "Contact";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "contact";
        $Menu->created_by = 1;
        $Menu->save();


        // Footer Menu Sub links
        // Home
        $Menu = new Menu();
        $Menu->row_no = 1;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "الرئيسية";
        $Menu->title_en = "Home";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "home";
        $Menu->created_by = 1;
        $Menu->save();
        // About
        $Menu = new Menu();
        $Menu->row_no = 2;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "من نحن";
        $Menu->title_en = "About Us";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "topic/about";
        $Menu->created_by = 1;
        $Menu->save();
        // Blog
        $Menu = new Menu();
        $Menu->row_no = 3;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "المدونة";
        $Menu->title_en = "Blog";
        $Menu->status = 1;
        $Menu->type = 2;
        $Menu->cat_id = 7;
        $Menu->link = "";
        $Menu->created_by = 1;
        $Menu->save();
        // Privacy
        $Menu = new Menu();
        $Menu->row_no = 4;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "الخصوصية";
        $Menu->title_en = "Privacy";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "topic/privacy";
        $Menu->created_by = 1;
        $Menu->save();
        // Terms
        $Menu = new Menu();
        $Menu->row_no = 5;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "الشروط والأحكام";
        $Menu->title_en = "Terms & Conditions";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "topic/terms";
        $Menu->created_by = 1;
        $Menu->save();
        // Contact
        $Menu = new Menu();
        $Menu->row_no = 6;
        $Menu->father_id = $Menu2->id;
        $Menu->title_ar = "اتصل بنا";
        $Menu->title_en = "Contact Us";
        $Menu->status = 1;
        $Menu->type = 1;
        $Menu->cat_id = 0;
        $Menu->link = "contact";
        $Menu->created_by = 1;
        $Menu->save();

    }
}
