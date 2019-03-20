<?php

namespace App\Http\Controllers;

use App;
use App\Banner;
use App\Comment;
use App\Contact;
use App\Http\Requests;
use App\Menu;
use App\Section;
use App\Setting;
use App\Topic;
use App\TopicCategory;
use App\User;
use App\Webmail;
use App\WebmasterSection;
use App\WebmasterSetting;
use Illuminate\Http\Request;
use Mail;


class FrontendHomeController extends Controller
{
    public function __construct()
    {
        // Check the website Status
        $WebsiteSettings = Setting::find(1);
        $lang = trans('backLang.boxCode');

        $site_status = $WebsiteSettings->site_status;
        $site_msg = $WebsiteSettings->close_msg;
        if ($site_status == 0) {
            // close the website
            if ($lang == "ar") {
                $site_title = $WebsiteSettings->site_title_ar;
                $site_desc = $WebsiteSettings->site_desc_ar;
                $site_keywords = $WebsiteSettings->site_keywords_ar;
            } else {
                $site_title = $WebsiteSettings->site_title_en;
                $site_desc = $WebsiteSettings->site_desc_en;
                $site_keywords = $WebsiteSettings->site_keywords_en;
            }
            echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<title>$site_title</title>
<meta name=\"description\" content=\"$site_desc\"/>
<meta name=\"keywords\" content=\"$site_keywords\"/>
<body>
<br>
<div style='text-align: center;'>
<p>$site_msg</p>
</div>
</body>
</html>
        ";
            exit();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int /string $seo_url_slug
     * @return \Illuminate\Http\Response
     */
    public function SEO($seo_url_slug = 0)
    {
        return $this->SEOByLang("", $seo_url_slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int /string $seo_url_slug
     * @return \Illuminate\Http\Response
     */
    public function SEOByLang($lang = "", $seo_url_slug = 0)
    {
        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        $seo_url_slug = str_slug($seo_url_slug, '-');

        switch ($seo_url_slug) {
            case "home" :
                return $this->HomePage();
                break;
            case "about" :
                $id = 1;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "privacy" :
                $id = 3;
                $section = 1;
                return $this->topic($section, $id);
                break;
            case "terms" :
                $id = 4;
                $section = 1;
                return $this->topic($section, $id);
                break;
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);
        $URL_Title = "seo_url_slug_" . trans('backLang.boxCode');

        $WebmasterSection1 = WebmasterSection::where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
        if (count($WebmasterSection1) > 0) {
            // MAIN SITE SECTION
            $section = $WebmasterSection1->id;
            return $this->topics($section, 0);
        } else {
            $WebmasterSection2 = WebmasterSection::where('name', $seo_url_slug)->first();
            if (count($WebmasterSection2) > 0) {
                // MAIN SITE SECTION
                $section = $WebmasterSection2->id;
                return $this->topics($section, 0);
            } else {
                $Section = Section::where('status', 1)->where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
                if (count($Section) > 0) {
                    // SITE Category
                    $section = $Section->webmaster_id;
                    $cat = $Section->id;
                    return $this->topics($section, $cat);
                } else {
                    $Topic = Topic::where('status', 1)->where("seo_url_slug_ar", $seo_url_slug)->orwhere("seo_url_slug_en", $seo_url_slug)->first();
                    if (count($Topic) > 0) {
                        // SITE Topic
                        $section_id = $Topic->webmaster_id;
                        $WebmasterSection = WebmasterSection::find($section_id);
                        $section = $WebmasterSection->name;
                        $id = $Topic->id;
                        return $this->topic($section, $id);
                    } else {
                        // Not found
                        return redirect()->route("HomePage");
                    }
                }
            }
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function HomePage()
    {
        return $this->HomePageByLang("");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function HomePageByLang($lang = "")
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // General for all pages
        $WebsiteSettings = Setting::find(1);
        $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
            1)->orderby('row_no',
            'asc')->get();
        $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
        $FooterMenuLinks_name_ar = "";
        $FooterMenuLinks_name_en = "";
        if (count($FooterMenuLinks_father) > 0) {
            $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
            $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
        }

        // Home topics
        $HomeTopics = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content1_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content1_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();
        // Home photos
        $HomePhotos = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content2_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content2_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(6)->get();
// Home Partners
        $HomePartners = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->home_content3_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->home_content3_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->get();

        // Get Latest News
        $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

        // Get Home page slider banners
        $SliderBanners = Banner::where('section_id', $WebmasterSettings->home_banners_section_id)->where('status',
            1)->orderby('row_no', 'asc')->get();

        // Get Home page Test banners
        $TextBanners = Banner::where('section_id', $WebmasterSettings->home_text_banners_section_id)->where('status',
            1)->orderby('row_no', 'asc')->get();

        $site_desc_var = "site_desc_" . trans('backLang.boxCode');
        $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

        $PageTitle = ""; // will show default site Title
        $PageDescription = $WebsiteSettings->$site_desc_var;
        $PageKeywords = $WebsiteSettings->$site_keywords_var;

        return view("frontEnd.home",
            compact("WebsiteSettings",
                "WebmasterSettings",
                "HeaderMenuLinks",
                "FooterMenuLinks",
                "SliderBanners",
                "TextBanners",
                "FooterMenuLinks_name_ar",
                "FooterMenuLinks_name_en",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "PageTitle",
                "PageDescription",
                "PageKeywords",
                "HomeTopics",
                "HomePhotos",
                "HomePartners",
                "LatestNews"));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function topic($section = 0, $id = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/$section", $lang_dirs)) {
            return $this->topicsByLang($section, $id, 0);
        } else {
            return $this->topicByLang("", $section, $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $cat
     * @return \Illuminate\Http\Response
     */
    public function topicsByLang($lang = "", $section = 0, $cat = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count($WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count($WebmasterSection) > 0) {

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = Section::find($cat);
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'asc')->get();

            if (count($CurrentCategory) > 0) {
                $category_topics = array();
                $TopicCategories = TopicCategory::where('section_id', $cat)->get();
                foreach ($TopicCategories as $category) {
                    $category_topics[] = $category->topic_id;
                }
                // update visits
                $CurrentCategory->visits = $CurrentCategory->visits + 1;
                $CurrentCategory->save();
                // Topics by Cat_ID
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed Topics fot this Category
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('visits', 'desc')->limit(3)->get();
            } else {
                // Topics if NO Cat_ID
                $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status',
                    1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();
            }

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count($FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();


            // Get Latest News
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            if (count($CurrentCategory) > 0) {
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($CurrentCategory->$seo_title_var != "") {
                    $PageTitle = $CurrentCategory->$seo_title_var;
                } else {
                    $PageTitle = $CurrentCategory->$tpc_title_var;
                }
                if ($CurrentCategory->$seo_description_var != "") {
                    $PageDescription = $CurrentCategory->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($CurrentCategory->$seo_keywords_var != "") {
                    $PageKeywords = $CurrentCategory->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
            } else {
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

                $PageTitle = trans('backLang.' . $WebmasterSection->name);
                $PageDescription = $WebsiteSettings->$site_desc_var;
                $PageKeywords = $WebsiteSettings->$site_keywords_var;

            }
            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                    "category_and_topics_count"));

        } else {

            return $this->SEOByLang($lang, $section);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function topicByLang($lang = "", $section = 0, $id = 0)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // check for pages called by name not id
        switch ($section) {
            case "about" :
                $id = 1;
                $section = 1;
                break;
            case "privacy" :
                $id = 3;
                $section = 1;
                break;
            case "terms" :
                $id = 4;
                $section = 1;
                break;
        }


        // get Webmaster section settings by name
        $WebmasterSection = WebmasterSection::where('name', $section)->first();
        if (count($WebmasterSection) == 0) {
            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($section);
        }
        if (count($WebmasterSection) > 0) {

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            $Topic = Topic::where('status', 1)->find($id);


            if (count($Topic) > 0 && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {
                // update visits
                $Topic->visits = $Topic->visits + 1;
                $Topic->save();

                // Get current Category Section details
                $CurrentCategory = array();
                $TopicCategory = TopicCategory::where('topic_id', $Topic->id)->first();
                if (count($TopicCategory) > 0) {
                    $CurrentCategory = Section::find($TopicCategory->section_id);
                }
                // Get a list of all Category ( for side bar )
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('status',
                    1)->where('father_id', '=', '0')->orderby('row_no', 'asc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count($FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

                // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($Topic->$seo_title_var != "") {
                    $PageTitle = $Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
                // .. end of .. Page Title, Description, Keywords


                return view("frontEnd.topic",
                    compact("WebsiteSettings",
                        "WebmasterSettings",
                        "HeaderMenuLinks",
                        "FooterMenuLinks",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "LatestNews",
                        "Topic",
                        "SideBanners",
                        "WebmasterSection",
                        "Categories",
                        "CurrentCategory",
                        "PageTitle",
                        "PageDescription",
                        "PageKeywords",
                        "TopicsMostViewed",
                        "category_and_topics_count"));

            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $section
     * @param  int $cat
     * @return \Illuminate\Http\Response
     */
    public function topics($section = 0, $cat = 0)
    {
        $lang_dirs = array_filter(glob(App::langPath() . '/*'), 'is_dir');
        // check if this like "/ar/blog"
        if (in_array(App::langPath() . "/$section", $lang_dirs)) {
            return $this->topicsByLang($section, $cat, 0);
        } else {
            return $this->topicsByLang("", $section, $cat);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopics($id)
    {
        return $this->userTopicsByLang("", $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function userTopicsByLang($lang = "", $id)
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        // get User Details
        $User = User::find($id);
        if (count($User) > 0) {


            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
            $WebmasterSection = "none";
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'asc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where([['created_by', $User->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where([['created_by', $User->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['created_by', $User->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count($FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();


            // Get Latest News
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $User->name;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "User",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                    "category_and_topics_count"));

        } else {
            // If no section name/ID go back to home
            return redirect()->action('FrontendHomeController@HomePage');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function searchTopics(Request $request)
    {

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $search_word = $request->search_word;

        if ($search_word != "") {

            // count topics by Category
            $category_and_topics_count = array();
            $AllSections = Section::where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($AllSections) > 0) {
                foreach ($AllSections as $AllSection) {
                    $category_topics = array();
                    $TopicCategories = TopicCategory::where('section_id', $AllSection->id)->get();
                    foreach ($TopicCategories as $category) {
                        $category_topics[] = $category->topic_id;
                    }

                    $Topics = Topic::where([['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['status', 1], ['expire_date', null]])->whereIn('id', $category_topics)->orderby('row_no', 'asc')->get();
                    $category_and_topics_count[$AllSection->id] = count($Topics);
                }
            }

            // Get current Category Section details
            $CurrentCategory = "none";
            $WebmasterSection = "none";
            // Get a list of all Category ( for side bar )
            $Categories = Section::where('father_id', '=',
                '0')->where('status', 1)->orderby('row_no', 'asc')->get();

            // Topics if NO Cat_ID
            $Topics = Topic::where('title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('title_en', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_ar', 'like', '%' . $search_word . '%')
                ->orwhere('seo_title_en', 'like', '%' . $search_word . '%')
                ->orwhere('details_ar', 'like', '%' . $search_word . '%')
                ->orwhere('details_en', 'like', '%' . $search_word . '%')
                ->orderby('id', 'desc')->paginate(env('FRONTEND_PAGINATION'));
            // Get Most Viewed
            $TopicsMostViewed = Topic::where([['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

            // General for all pages

            $WebsiteSettings = Setting::find(1);
            $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                1)->orderby('row_no',
                'asc')->get();
            $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
            $FooterMenuLinks_name_ar = "";
            $FooterMenuLinks_name_en = "";
            if (count($FooterMenuLinks_father) > 0) {
                $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
            }
            $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                1)->orderby('row_no', 'asc')->get();


            // Get Latest News
            $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

            // Page Title, Description, Keywords
            $site_desc_var = "site_desc_" . trans('backLang.boxCode');
            $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');

            $PageTitle = $search_word;
            $PageDescription = $WebsiteSettings->$site_desc_var;
            $PageKeywords = $WebsiteSettings->$site_keywords_var;

            // .. end of .. Page Title, Description, Keywords

            // Send all to the view
            return view("frontEnd.topics",
                compact("WebsiteSettings",
                    "WebmasterSettings",
                    "HeaderMenuLinks",
                    "FooterMenuLinks",
                    "FooterMenuLinks_name_ar",
                    "FooterMenuLinks_name_en",
                    "LatestNews",
                    "search_word",
                    "SideBanners",
                    "WebmasterSection",
                    "Categories",
                    "Topics",
                    "CurrentCategory",
                    "PageTitle",
                    "PageDescription",
                    "PageKeywords",
                    "TopicsMostViewed",
                    "category_and_topics_count"));

        } else {
            // If no section name/ID go back to home
            return redirect()->action('FrontendHomeController@HomePage');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactPage()
    {
        return $this->ContactPageByLang("");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactPageByLang($lang = "")
    {

        if ($lang != "") {
            // Set Language
            App::setLocale($lang);
            \Session::put('locale', $lang);
        }
        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $id = $WebmasterSettings->contact_page_id;
        $Topic = Topic::where('status', 1)->find($id);


        if (count($Topic) > 0 && ($Topic->expire_date == '' || ($Topic->expire_date != '' && $Topic->expire_date >= date("Y-m-d")))) {

            // update visits
            $Topic->visits = $Topic->visits + 1;
            $Topic->save();

            // get Webmaster section settings by ID
            $WebmasterSection = WebmasterSection::find($Topic->webmaster_id);

            if (count($WebmasterSection) > 0) {

                // Get current Category Section details
                $CurrentCategory = Section::find($Topic->section_id);
                // Get a list of all Category ( for side bar )
                $Categories = Section::where('webmaster_id', '=', $WebmasterSection->id)->where('father_id', '=',
                    '0')->where('status', 1)->orderby('row_no', 'asc')->get();

                // Get Most Viewed
                $TopicsMostViewed = Topic::where([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['webmaster_id', '=', $WebmasterSection->id], ['status', 1], ['expire_date', null]])->orderby('visits', 'desc')->limit(3)->get();

                // General for all pages

                $WebsiteSettings = Setting::find(1);
                $HeaderMenuLinks = Menu::where('father_id', $WebmasterSettings->header_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks = Menu::where('father_id', $WebmasterSettings->footer_menu_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();
                $FooterMenuLinks_father = Menu::find($WebmasterSettings->footer_menu_id);
                $FooterMenuLinks_name_ar = "";
                $FooterMenuLinks_name_en = "";
                if (count($FooterMenuLinks_father) > 0) {
                    $FooterMenuLinks_name_ar = $FooterMenuLinks_father->title_ar;
                    $FooterMenuLinks_name_en = $FooterMenuLinks_father->title_en;
                }
                $SideBanners = Banner::where('section_id', $WebmasterSettings->side_banners_section_id)->where('status',
                    1)->orderby('row_no', 'asc')->get();

                // Get Latest News
                $LatestNews = Topic::where([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['webmaster_id', $WebmasterSettings->latest_news_section_id], ['expire_date', null]])->orderby('row_no', 'asc')->limit(3)->get();

                // Page Title, Description, Keywords
                $seo_title_var = "seo_title_" . trans('backLang.boxCode');
                $seo_description_var = "seo_description_" . trans('backLang.boxCode');
                $seo_keywords_var = "seo_keywords_" . trans('backLang.boxCode');
                $tpc_title_var = "title_" . trans('backLang.boxCode');
                $site_desc_var = "site_desc_" . trans('backLang.boxCode');
                $site_keywords_var = "site_keywords_" . trans('backLang.boxCode');
                if ($Topic->$seo_title_var != "") {
                    $PageTitle = $Topic->$seo_title_var;
                } else {
                    $PageTitle = $Topic->$tpc_title_var;
                }
                if ($Topic->$seo_description_var != "") {
                    $PageDescription = $Topic->$seo_description_var;
                } else {
                    $PageDescription = $WebsiteSettings->$site_desc_var;
                }
                if ($Topic->$seo_keywords_var != "") {
                    $PageKeywords = $Topic->$seo_keywords_var;
                } else {
                    $PageKeywords = $WebsiteSettings->$site_keywords_var;
                }
                // .. end of .. Page Title, Description, Keywords

                return view("frontEnd.contact",
                    compact("WebsiteSettings",
                        "WebmasterSettings",
                        "HeaderMenuLinks",
                        "FooterMenuLinks",
                        "FooterMenuLinks_name_ar",
                        "FooterMenuLinks_name_en",
                        "LatestNews",
                        "Topic",
                        "SideBanners",
                        "WebmasterSection",
                        "Categories",
                        "CurrentCategory",
                        "PageTitle",
                        "PageDescription",
                        "PageKeywords",
                        "TopicsMostViewed"));

            } else {
                return redirect()->action('FrontendHomeController@HomePage');
            }
        } else {
            return redirect()->action('FrontendHomeController@HomePage');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function ContactPageSubmit(Request $request)
    {

        $this->validate($request, [
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_subject' => 'required',
            'contact_message' => 'required'
        ]);

        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }
        // SITE SETTINGS
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        $Webmail = new Webmail;
        $Webmail->cat_id = 0;
        $Webmail->group_id = null;
        $Webmail->title = $request->contact_subject;
        $Webmail->details = $request->contact_message;
        $Webmail->date = date("Y-m-d H:i:s");
        $Webmail->from_email = $request->contact_email;
        $Webmail->from_name = $request->contact_name;
        $Webmail->from_phone = $request->contact_phone;
        $Webmail->to_email = $WebsiteSettings->site_webmails;
        $Webmail->to_name = $site_title;
        $Webmail->status = 0;
        $Webmail->flag = 0;
        $Webmail->save();

        // SEND Notification Email
        if ($WebsiteSettings->notify_messages_status) {
            if (env('MAIL_USERNAME') != "") {
                Mail::send('backEnd.emails.webmail', [
                    'title' => "NEW MESSAGE:" . $request->contact_subject,
                    'details' => $request->contact_message,
                    'websiteURL' => $site_url,
                    'websiteName' => $site_title
                ], function ($message) use ($request, $site_email, $site_title) {
                    $message->from(env('NO_REPLAY_EMAIL', $request->contact_email), $request->contact_name);
                    $message->to($site_email);
                    $message->replyTo($request->contact_email, $site_title);
                    $message->subject($request->contact_subject);

                });
            }
        }

        return "OK";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function subscribeSubmit(Request $request)
    {


        $this->validate($request, [
            'subscribe_name' => 'required',
            'subscribe_email' => 'required|email'
        ]);

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $Contacts = Contact::where('email', $request->subscribe_email)->get();
        if (count($Contacts) > 0) {
            return trans('frontLang.subscribeToOurNewsletterError');
        } else {
            $subscribe_names = explode(' ', $request->subscribe_name, 2);

            $Contact = new Contact;
            $Contact->group_id = $WebmasterSettings->newsletter_contacts_group;
            $Contact->first_name = @$subscribe_names[0];
            $Contact->last_name = @$subscribe_names[1];
            $Contact->email = $request->subscribe_email;
            $Contact->status = 1;
            $Contact->save();

            return "OK";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function commentSubmit(Request $request)
    {

        $this->validate($request, [
            'comment_name' => 'required',
            'comment_message' => 'required',
            'topic_id' => 'required',
            'comment_email' => 'required|email'
        ]);

        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }

        // General Webmaster Settings
        $WebmasterSettings = WebmasterSetting::find(1);

        $next_nor_no = Comment::where('topic_id', '=', $request->topic_id)->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        $Comment = new Comment;
        $Comment->row_no = $next_nor_no;
        $Comment->name = $request->comment_name;
        $Comment->email = $request->comment_email;
        $Comment->comment = $request->comment_message;
        $Comment->topic_id = $request->topic_id;;
        $Comment->date = date("Y-m-d H:i:s");
        $Comment->status = $WebmasterSettings->new_comments_status;
        $Comment->save();

        // Site Details
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        // Topic details
        $Topic = Topic::where('status', 1)->find($request->topic_id);
        if (count($Topic) > 0) {
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $tpc_title = $WebsiteSettings->$tpc_title_var;

            // SEND Notification Email
            if ($WebsiteSettings->notify_comments_status) {
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => "NEW Comment on :" . $tpc_title,
                        'details' => $request->comment_message,
                        'websiteURL' => $site_url,
                        'websiteName' => $site_title
                    ], function ($message) use ($request, $site_email, $site_title, $tpc_title) {
                        $message->from(env('NO_REPLAY_EMAIL', $request->comment_email), $request->comment_name);
                        $message->to($site_email);
                        $message->replyTo($request->comment_email, $site_title);
                        $message->subject("NEW Comment on :" . $tpc_title);

                    });
                }
            }
        }

        return "OK";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderSubmit(Request $request)
    {

        $this->validate($request, [
            'order_name' => 'required',
            'order_phone' => 'required',
            'order_qty' => 'required',
            'topic_id' => 'required',
            'order_email' => 'required|email'
        ]);


        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;

        $Topic = Topic::where('status', 1)->find($request->topic_id);
        if (count($Topic) > 0) {
            $tpc_title_var = "title_" . trans('backLang.boxCode');
            $tpc_title = $WebsiteSettings->$tpc_title_var;

            $Webmail = new Webmail;
            $Webmail->cat_id = 0;
            $Webmail->group_id = null;
            $Webmail->contact_id = null;
            $Webmail->father_id = null;
            $Webmail->title = "ORDER " . ", Qty=" . $request->order_qty . ", " . $Topic->$tpc_title_var;
            $Webmail->details = $request->order_message;
            $Webmail->date = date("Y-m-d H:i:s");
            $Webmail->from_email = $request->order_email;
            $Webmail->from_name = $request->order_name;
            $Webmail->from_phone = $request->order_phone;
            $Webmail->to_email = $WebsiteSettings->site_webmails;
            $Webmail->to_name = $WebsiteSettings->$site_title_var;
            $Webmail->status = 0;
            $Webmail->flag = 0;
            $Webmail->save();


            // SEND Notification Email
            $msg_details = "$tpc_title <br> Qty = " . $request->order_qty . "<hr>" . $request->order_message;
            if ($WebsiteSettings->notify_orders_status) {
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => "NEW Order on :" . $tpc_title,
                        'details' => $msg_details,
                        'websiteURL' => $site_url,
                        'websiteName' => $site_title
                    ], function ($message) use ($request, $site_email, $site_title, $tpc_title) {
                        $message->from(env('NO_REPLAY_EMAIL', $request->order_email), $request->order_name);
                        $message->to($site_email);
                        $message->replyTo($request->order_email, $site_title);
                        $message->subject("NEW Comment on :" . $tpc_title);

                    });
                }
            }
        }

        return "OK";
    }

}
