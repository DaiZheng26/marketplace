<?php

namespace App\Http\Controllers;

use App\AttachFile;
use App\Banner;
use App\Comment;
use App\Contact;
use App\Map;
use App\Menu;
use App\Photo;
use App\Section;
use App\Setting;
use App\Topic;
use App\Webmail;
use App\WebmasterSection;
use App\WebmasterSetting;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Mail;

class APIsController extends Controller
{
    public function __construct()
    {
        // Check API Status
        if (!Helper::GeneralWebmasterSettings("api_status")) {
            // API disabled
            exit();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<title>API v1 | Restful Web Services</title>
<body>
<br>
<div>
Restful Web Services: <br>
---------------------------------------- <br>
{ GET }     /api/v1/website/status <br>
{ GET }     /api/v1/website/info <br>
{ GET }     /api/v1/website/contacts <br>
{ GET }     /api/v1/website/style <br>
{ GET }     /api/v1/website/social <br>
{ GET }     /api/v1/website/settings <br>
{ GET }     /api/v1/menu/ <br>
{ GET }     /api/v1/banners/ <br>
{ GET }     /api/v1/section/ <br>
{ GET }     /api/v1/categories/ <br>
{ GET }     /api/v1/topics/ <br>
{ GET }     /api/v1/topic/ <br>
{ GET }     /api/v1/topic/fields/ <br>
{ GET }     /api/v1/topic/photos/ <br>
{ GET }     /api/v1/topic/photo/ <br>
{ GET }     /api/v1/topic/maps/ <br>
{ GET }     /api/v1/topic/map/ <br>
{ GET }     /api/v1/topic/files/ <br>
{ GET }     /api/v1/topic/file/ <br>
{ GET }     /api/v1/topic/comments/ <br>
{ GET }     /api/v1/topic/comment/ <br>
{ GET }     /api/v1/topic/related/ <br>
{ GET }     /api/v1/user/ <br>
{ POST }   /api/v1/subscribe <br>
{ POST }   /api/v1/comment <br>
{ POST }   /api/v1/order <br>
{ POST }   /api/v1/contact <br>
---------------------------------------- <br>
For more details check <a href='http://smartfordesign.net/smartend/documentation/api.html' target='_blank'><strong>API documentation</strong></a>
</div>
</body>
</html>
        ";
        exit();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_status()
    {
        // Get Site Settings
        $Setting = Setting::find(1);
        // Response Details
        $msg = "";
        if ($Setting->site_status == 0) {
            $msg = nl2br($Setting->close_msg);
        }
        $response_details = [
            'status' => $Setting->site_status,
            'close_msg' => $msg
        ];
        // Response MSG
        $response = [
            'msg' => 'Website Status details',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    //Language check

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_info($lang = '')
    {
        // Get Site Settings
        $Setting = Setting::find(1);

        // By Language
        $lang = $this->getLanguage($lang);
        $site_title_var = "site_title_$lang";
        $site_desc_var = "site_desc_$lang";
        $site_keywords_var = "site_keywords_$lang";

        // Response Details
        $response_details = [
            'site_url' => $Setting->site_url,
            'site_title' => $Setting->$site_title_var,
            'site_desc' => $Setting->$site_desc_var,
            'site_keywords' => $Setting->$site_keywords_var,
            'site_webmails' => $Setting->site_webmails
        ];
        // Response MSG
        $response = [
            'msg' => 'Main information about the Website',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    /**
     * Language Check
     */
    public function getLanguage($lang)
    {
        // List of active languages for API
        $languages = array("ar", "en");

        if ($lang == "" || !in_array($lang, $languages)) {
            $lang = env('DEFAULT_LANGUAGE');
        }
        return $lang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_contacts($lang = '')
    {
        // Get Site Settings
        $Setting = Setting::find(1);

        // By Language
        $lang = $this->getLanguage($lang);
        $address_var = "contact_t1_$lang";
        $working_time_var = "contact_t7_$lang";

        // Response Details
        $response_details = [
            'address' => $Setting->$address_var,
            'phone' => $Setting->contact_t3,
            'fax' => $Setting->contact_t4,
            'mobile' => $Setting->contact_t5,
            'email' => $Setting->contact_t6,
            'working_time' => $Setting->$working_time_var
        ];
        // Response MSG
        $response = [
            'msg' => 'List of Contacts Details',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_style($lang = '')
    {
        // Get Site Settings
        $Setting = Setting::find(1);

        // By Language
        $lang = $this->getLanguage($lang);
        $style_logo_var = "style_logo_$lang";

        // Response Details
        $response_details = [
            'logo' => ($Setting->$style_logo_var != "") ? url("") . "/uploads/settings/" . $Setting->$style_logo_var : null,
            'fav_icon' => ($Setting->style_fav != "") ? url("") . "/uploads/settings/" . $Setting->style_fav : null,
            'apple_icon' => ($Setting->style_apple != "") ? url("") . "/uploads/settings/" . $Setting->style_apple : null,
            'style_color_1' => $Setting->style_color1,
            'style_color_2' => $Setting->style_color2,
            'layout_mode' => $Setting->style_type,
            'bg_type' => $Setting->style_bg_type,
            'bg_pattern' => ($Setting->style_bg_pattern != "") ? url("") . "/uploads/pattern/" . $Setting->style_bg_pattern : null,
            'bg_color' => $Setting->style_bg_color,
            'bg_image' => ($Setting->style_bg_image != "") ? url("") . "/uploads/settings/" . $Setting->style_bg_image : null,
            'footer_style' => $Setting->style_footer,
            'footer_bg' => ($Setting->style_footer_bg != "") ? url("") . "/uploads/settings/" . $Setting->style_footer_bg : null,
            'newsletter_subscribe_status' => $Setting->style_subscribe,
            'preload_status' => $Setting->style_preload
        ];
        // Response MSG
        $response = [
            'msg' => 'List of Style Settings',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_social()
    {
        // Get Site Settings
        $Setting = Setting::find(1);

        // Response Details
        $response_details = [
            'facebook' => $Setting->social_link1,
            'twitter' => $Setting->social_link2,
            'google' => $Setting->social_link3,
            'linkedin' => $Setting->social_link4,
            'youtube' => $Setting->social_link5,
            'instagram' => $Setting->social_link6,
            'pinterest' => $Setting->social_link7,
            'tumblr' => $Setting->social_link8,
            'flickr' => $Setting->social_link9,
            'whatsapp' => $Setting->social_link10,
        ];
        // Response MSG
        $response = [
            'msg' => 'List of Social Networks Links',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function website_settings()
    {
        // Get Site Settings
        $WebmasterSetting = WebmasterSetting::find(1);

        // Response Details
        $response_details = [
            'languages_count' => $WebmasterSetting->languages_count,
            'new_comments_status' => $WebmasterSetting->new_comments_status,
            'allow_register_status' => $WebmasterSetting->register_status,
            'register_permission_group' => $WebmasterSetting->permission_group,
            'contact_text_page_id' => $WebmasterSetting->contact_page_id,
            'header_menu_id' => $WebmasterSetting->header_menu_id,
            'footer_menu_id' => $WebmasterSetting->footer_menu_id,
            'latest_news_section_id' => $WebmasterSetting->latest_news_section_id,
            'newsletter_contacts_group' => $WebmasterSetting->newsletter_contacts_group,
            'home_content1_section_id' => $WebmasterSetting->home_content1_section_id,
            'home_content2_section_id' => $WebmasterSetting->home_content2_section_id,
            'home_content3_section_id' => $WebmasterSetting->home_content3_section_id,
            'home_banners_section_id' => $WebmasterSetting->home_banners_section_id,
            'home_text_banners_section_id' => $WebmasterSetting->home_text_banners_section_id,
            'side_banners_section_id' => $WebmasterSetting->side_banners_section_id
        ];
        // Response MSG
        $response = [
            'msg' => 'General Website Settings',
            'details' => $response_details
        ];
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu($menu_id, $lang = '')
    {
        if ($menu_id > 0) {
            // Get menu details
            $Menu = Menu::where('father_id', $menu_id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($Menu) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";

                // Response Details
                $response_details = [];
                foreach ($Menu as $MenuLink) {
                    $SubMenu = Menu::where('father_id', $MenuLink->id)->where('status', 1)->orderby('row_no', 'asc')->get();
                    $sub_response_details = [];
                    if (count($SubMenu) > 0) {
                        foreach ($SubMenu as $SubMenuLink) {
                            $m_link = "";
                            if ($SubMenuLink->type == 3 || $SubMenuLink->type == 2) {
                                $m_link = $SubMenuLink->webmasterSection->name;
                            } elseif ($SubMenuLink->type == 1) {
                                $m_link = $MenuLink->link;
                            }
                            $sub_response_details[] = [
                                'id' => $SubMenuLink->id,
                                'title' => $SubMenuLink->$title_var,
                                'section_id' => $SubMenuLink->cat_id,
                                'href' => $m_link
                            ];
                        }
                    }

                    $m_link = "";
                    $sub_count = count($SubMenu);
                    if ($MenuLink->type == 3) {
                        // Section with drop list
                        $m_link = $MenuLink->webmasterSection->name;
                        $sub_count = count($MenuLink->webmasterSection->sections);
                        foreach ($MenuLink->webmasterSection->sections as $SubSection) {
                            $sub_response_details[] = [
                                'id' => $SubSection->id,
                                'title' => $SubSection->$title_var,
                                'section_id' => $MenuLink->cat_id,
                                'href' => "topics/cat/" . $SubSection->id
                            ];
                        }
                    } elseif ($MenuLink->type == 2) {
                        // Section Link
                        $m_link = $MenuLink->webmasterSection->name;
                    } elseif ($MenuLink->type == 1) {
                        $m_link = $MenuLink->link;
                    }
                    $response_details[] = [
                        'id' => $MenuLink->id,
                        'title' => $MenuLink->$title_var,
                        'section_id' => $MenuLink->cat_id,
                        'href' => $m_link,
                        'sub_links_count' => $sub_count,
                        'sub_links' => $sub_response_details
                    ];
                    // sub links

                }
                // Response MSG
                $response = [
                    'msg' => 'List of Menu Links',
                    'links_count' => count($Menu),
                    'links' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banners($group_id, $lang = '')
    {
        if ($group_id > 0) {
            // Get banners
            $Banners = Banner::where('section_id', $group_id)->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($Banners) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_$lang";
                $file_var = "file_$lang";

                // Response Details
                $response_details = [];
                $type = "";
                foreach ($Banners as $Banner) {
                    $type = $Banner->webmasterBanner->type;
                    $response_details[] = [
                        'id' => $Banner->id,
                        'title' => $Banner->$title_var,
                        'details' => nl2br($Banner->$details_var),
                        'file' => ($Banner->$file_var != "") ? url("") . "/uploads/banners/" . $Banner->$file_var : null,
                        'video_type' => $Banner->video_type,
                        'youtube_link' => $Banner->youtube_link,
                        'link_url' => $Banner->link_url,
                        'icon' => $Banner->icon
                    ];
                }
                // Response MSG
                $response = [
                    'msg' => 'List of Banners',
                    'type' => $type,
                    'banners_count' => count($Banners),
                    'banners' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function section($section_id, $lang = '')
    {
        if ($section_id > 0) {
            // Get categories
            $WebmasterSections = WebmasterSection::where('id', $section_id)->where('status', 1)->get();
            if (count($WebmasterSections) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $section_name = "";
                $section_title = "";
                $type = "";
                $sections_status = "";

                // Response Details
                $response_details = [];
                foreach ($WebmasterSections as $WebmasterSection) {
                    $type = $WebmasterSection->type;
                    $sections_status = $WebmasterSection->sections_status;
                    $section_name = $WebmasterSection->name;
                    $section_title = trans('backLang.' . $WebmasterSection->name, [], $lang);
                }
                // Response MSG
                $response = [
                    'msg' => 'Website Section Details',
                    'section_id' => $section_id,
                    'title' => $section_title,
                    'href' => "/" . $WebmasterSection->name,
                    'type' => $type,
                    'categories_status' => $sections_status
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories($section_id, $lang = '')
    {
        if ($section_id > 0) {
            // Get categories
            $Sections = Section::where('webmaster_id', $section_id)->where('father_id', '0')->where('status', 1)->orderby('row_no', 'asc')->get();
            if (count($Sections) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $section_name = "";
                $type = "";
                $section_title = "";

                // Response Details
                $response_details = [];
                foreach ($Sections as $Section) {
                    $type = $Section->webmasterSection->type;
                    $section_name = $Section->webmasterSection->name;
                    $section_title = trans('backLang.' . $Section->webmasterSection->name, [], $lang);

                    $SubSections = Section::where('webmaster_id', $section_id)->where('father_id', $Section->id)->where('status', 1)->orderby('row_no', 'asc')->get();
                    $sub_response_details = [];
                    foreach ($SubSections as $SubSection) {
                        $sub_response_details[] = [
                            'id' => $SubSection->id,
                            'title' => $SubSection->$title_var,
                            'icon' => $SubSection->icon,
                            'photo' => ($SubSection->photo != "") ? url("") . "/uploads/sections/" . $SubSection->photo : null,
                            'href' => "topics/cat/" . $SubSection->id,
                        ];
                    }

                    $response_details[] = [
                        'id' => $Section->id,
                        'title' => $Section->$title_var,
                        'icon' => $Section->icon,
                        'photo' => ($Section->photo != "") ? url("") . "/uploads/sections/" . $Section->photo : null,
                        'href' => "topics/cat/" . $Section->id,
                        'sub_categories_count' => count($SubSections),
                        'sub_categories' => $sub_response_details
                    ];

                }
                // Response MSG
                $response = [
                    'msg' => 'List of Categories',
                    'section_id' => $section_id,
                    'section_title' => $section_title,
                    'type' => $type,
                    'categories_count' => count($Sections),
                    'categories' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topics($section_id, $page_number = 1, $topics_count = 0, $lang = '')
    {
        if ($section_id > 0) {
            if ($page_number < 1) {
                $page_number = 1;
            }
            Paginator::currentPageResolver(function () use ($page_number) {
                return $page_number;
            });

            // Get topics
            $Topics = Topic::where([['webmaster_id', '=', $section_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['webmaster_id', '=', $section_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc');

            if ($topics_count > 0) {
                $Topics = $Topics->paginate($topics_count);
            } else {
                $Topics = $Topics->get();
            }

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_ar$lang";
                $section_name = "";
                $type = "";
                $section_title = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $type = $Topic->webmasterSection->type;
                    $section_name = $Topic->webmasterSection->name;
                    $section_title = trans('backLang.' . $Topic->webmasterSection->name, [], $lang);


                    $Joined_categories = [];
                    foreach ($Topic->categories as $category) {
                        $Joined_categories[] = [
                            'id' => $category->id,
                            'title' => $category->section->$title_var,
                            'icon' => $category->section->icon,
                            'photo' => ($category->section->photo != "") ? url("") . "/uploads/sections/" . $category->section->photo : null,
                            'href' => "topics/cat/" . $category->id
                        ];
                    }

                    // additional fields
                    $Additional_fields = [];
                    foreach ($Topic->webmasterSection->customFields as $customField) {

                        $cf_saved_val = "";
                        $cf_saved_val_array = array();
                        if (count($Topic->fields) > 0) {
                            foreach ($Topic->fields as $t_field) {
                                if ($t_field->field_id == $customField->id) {
                                    if ($customField->type == 7) {
                                        // if multi check
                                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                                    } else {
                                        $cf_saved_val = $t_field->field_value;
                                    }
                                }
                            }
                        }

                        if (($cf_saved_val != "" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == "$lang")) {
                            $Additional_fields[] = [
                                'type' => $customField->type,
                                'title' => $customField->$title_var,
                                'value' => $cf_saved_val,
                            ];
                        }
                    }

                    $video_file = $Topic->video_file;
                    if ($Topic->video_type == 0) {
                        $video_file = ($Topic->video_file != "") ? url("") . "/uploads/topics/" . $Topic->video_file : "";
                    }

                    $response_details[] = [
                        'id' => $Topic->id,
                        'title' => $Topic->$title_var,
                        'details' => $Topic->$details_var,
                        'date' => $Topic->date,
                        'video_type' => $Topic->video_type,
                        'video_file' => $video_file,
                        'photo_file' => ($Topic->photo_file != "") ? url("") . "/uploads/topics/" . $Topic->photo_file : null,
                        'audio_file' => ($Topic->audio_file != "") ? url("") . "/uploads/topics/" . $Topic->audio_file : null,
                        'icon' => $Topic->icon,
                        'visits' => $Topic->visits,
                        'href' => "topic/" . $Topic->id,
                        'fields_count' => count($Additional_fields),
                        'fields' => $Additional_fields,
                        'Joined_categories_count' => count($Topic->categories),
                        'Joined_categories' => $Joined_categories,
                        'user' => [
                            'id' => $Topic->user->id,
                            'name' => $Topic->user->name,
                            'href' => "user/" . $Topic->user->id . "/topics",
                        ]

                    ];

                }
                // Response MSG
                $response = [
                    'msg' => 'List of Topics',
                    'section_id' => $section_id,
                    'section_title' => $section_title,
                    'type' => $type,
                    'topics_count' => count($Topics),
                    'topics' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_$lang";
                $section_name = "";
                $type = "";
                $section_id = "";
                $section_title = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $type = $Topic->webmasterSection->type;
                    $section_id = $Topic->webmasterSection->id;
                    $section_name = $Topic->webmasterSection->name;
                    $section_title = trans('backLang.' . $Topic->webmasterSection->name, [], $lang);

                    // additional fields
                    $Additional_fields = [];
                    foreach ($Topic->webmasterSection->customFields as $customField) {

                        $cf_saved_val = "";
                        $cf_saved_val_array = array();
                        if (count($Topic->fields) > 0) {
                            foreach ($Topic->fields as $t_field) {
                                if ($t_field->field_id == $customField->id) {
                                    if ($customField->type == 7) {
                                        // if multi check
                                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                                    } else {
                                        $cf_saved_val = $t_field->field_value;
                                    }
                                }
                            }
                        }

                        if (($cf_saved_val != "" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == "$lang")) {
                            $Additional_fields[] = [
                                'type' => $customField->type,
                                'title' => $customField->$title_var,
                                'value' => $cf_saved_val,
                            ];
                        }
                    }

                    // categories
                    $Joined_categories = [];
                    foreach ($Topic->categories as $category) {
                        $Joined_categories[] = [
                            'id' => $category->id,
                            'title' => $category->section->$title_var,
                            'icon' => $category->section->icon,
                            'photo' => ($category->section->photo != "") ? url("") . "/uploads/sections/" . $category->section->photo : null,
                            'href' => "topics/cat/" . $category->id
                        ];
                    }
                    // photos
                    $Photos = [];
                    foreach ($Topic->photos as $photo) {
                        $Photos[] = [
                            'id' => $photo->id,
                            'title' => $photo->title,
                            'url' => ($photo->file != "") ? url("") . "/uploads/topics/" . $photo->file : null,
                            'href' => "/topic/photo/" . $photo->id
                        ];
                    }
                    // maps
                    $Maps = [];
                    foreach ($Topic->maps as $map) {
                        $Maps[] = [
                            'id' => $map->id,
                            'longitude' => $map->longitude,
                            'latitude' => $map->latitude,
                            'title' => $map->$title_var,
                            'details' => $map->$details_var,
                            'href' => "/topic/map/" . $map->id
                        ];
                    }
                    // attach files
                    $Attach_files = [];
                    foreach ($Topic->attachFiles as $attachFile) {
                        $Attach_files[] = [
                            'id' => $attachFile->id,
                            'title' => $attachFile->$title_var,
                            'url' => ($attachFile->file != "") ? url("") . "/uploads/topics/" . $attachFile->file : null,
                            'href' => "/topic/file/" . $attachFile->id
                        ];
                    }
                    // comments
                    $Comments = [];
                    foreach ($Topic->approvedComments as $comment) {
                        $Comments[] = [
                            'id' => $comment->id,
                            'name' => $comment->name,
                            'email' => $comment->email,
                            'date' => $comment->date,
                            'comment' => nl2br($comment->comment),
                            'href' => "/topic/comment/" . $comment->id
                        ];
                    }
                    // related topics
                    $Related_topics = [];
                    foreach ($Topic->relatedTopics as $relatedTopic) {
                        $Related_topics[] = [
                            'id' => $relatedTopic->topic->id,
                            'title' => $relatedTopic->topic->$title_var,
                            'date' => $relatedTopic->topic->date,
                            'href' => "topic/" . $relatedTopic->topic->id,
                            'photo_file' => ($relatedTopic->topic->photo_file != "") ? url("") . "/uploads/topics/" . $relatedTopic->topic->photo_file : null
                        ];
                    }

                    $video_file = $Topic->video_file;
                    if ($Topic->video_type == 0) {
                        $video_file = ($Topic->video_file != "") ? url("") . "/uploads/topics/" . $Topic->video_file : "";
                    }

                    $response_details[] = [
                        'id' => $Topic->id,
                        'title' => $Topic->$title_var,
                        'details' => $Topic->$details_var,
                        'date' => $Topic->date,
                        'video_type' => $Topic->video_type,
                        'video_file' => $video_file,
                        'photo_file' => ($Topic->photo_file != "") ? url("") . "/uploads/topics/" . $Topic->photo_file : null,
                        'audio_file' => ($Topic->audio_file != "") ? url("") . "/uploads/topics/" . $Topic->audio_file : null,
                        'icon' => $Topic->icon,
                        'visits' => $Topic->visits,
                        'href' => "topic/" . $Topic->id,
                        'fields_count' => count($Additional_fields),
                        'fields' => $Additional_fields,
                        'Joined_categories_count' => count($Joined_categories),
                        'Joined_categories' => $Joined_categories,
                        'photos_count' => count($Photos),
                        'photos' => $Photos,
                        'attach_files_count' => count($Attach_files),
                        'attach_files' => $Attach_files,
                        'maps_count' => count($Maps),
                        'maps' => $Maps,
                        'comments_count' => count($Comments),
                        'comments' => $Comments,
                        'related_topics_count' => count($Related_topics),
                        'related_topics' => $Related_topics,
                        'user' => [
                            'id' => $Topic->user->id,
                            'name' => $Topic->user->name,
                            'href' => "user/" . $Topic->user->id . "/topics",
                        ]

                    ];

                }
                // Response MSG
                $response = [
                    'msg' => 'Details of topic',
                    'section_id' => $section_id,
                    'section_title' => $section_title,
                    'type' => $type,
                    'topic' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_photos($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // photos
                    $response_details = [];
                    foreach ($Topic->photos as $photo) {
                        $response_details[] = [
                            'id' => $photo->id,
                            'title' => $photo->title,
                            'url' => ($photo->file != "") ? url("") . "/uploads/topics/" . $photo->file : null,
                            'href' => "/topic/photo/" . $photo->id
                        ];
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Photos of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'photos_count' => count($response_details),
                    'photos' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_photo($photo_id, $lang = '')
    {
        if ($photo_id > 0) {

            // Get Photo details
            $Photo = Photo::find($photo_id);

            if (count($Photo) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                $response_details[] = [
                    'id' => $Photo->id,
                    'title' => $Photo->title,
                    'url' => ($Photo->file != "") ? url("") . "/uploads/topics/" . $Photo->file : null
                ];

                // Response MSG
                $response = [
                    'msg' => 'Photo details',
                    'topic_id' => $Photo->topic_id,
                    'photo' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_maps($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // maps
                    $response_details = [];
                    foreach ($Topic->maps as $map) {
                        $response_details[] = [
                            'id' => $map->id,
                            'longitude' => $map->longitude,
                            'latitude' => $map->latitude,
                            'title' => $map->$title_var,
                            'details' => $map->$details_var,
                            'href' => "/topic/map/" . $map->id
                        ];
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Maps of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'maps_count' => count($response_details),
                    'maps' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_map($map_id, $lang = '')
    {
        if ($map_id > 0) {

            // Get map details
            $Map = Map::find($map_id);

            if (count($Map) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_$lang";

                $response_details[] = [
                    'id' => $Map->id,
                    'longitude' => $Map->longitude,
                    'latitude' => $Map->latitude,
                    'title' => $Map->$title_var,
                    'details' => $Map->$details_var
                ];

                // Response MSG
                $response = [
                    'msg' => 'Map details',
                    'topic_id' => $Map->topic_id,
                    'map' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_files($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // attach files
                    $response_details = [];
                    foreach ($Topic->attachFiles as $attachFile) {
                        $response_details[] = [
                            'id' => $attachFile->id,
                            'title' => $attachFile->$title_var,
                            'url' => ($attachFile->file != "") ? url("") . "/uploads/topics/" . $attachFile->file : null,
                            'href' => "/topic/file/" . $attachFile->id
                        ];
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Attach files of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'files_count' => count($response_details),
                    'files' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_file($file_id, $lang = '')
    {
        if ($file_id > 0) {

            // Get topic details
            $AttachFile = AttachFile::find($file_id);

            if (count($AttachFile) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";

                $response_details[] = [
                    'id' => $AttachFile->id,
                    'title' => $AttachFile->$title_var,
                    'url' => ($AttachFile->file != "") ? url("") . "/uploads/topics/" . $AttachFile->file : null
                ];

                // Response MSG
                $response = [
                    'msg' => 'Attach file details',
                    'topic_id' => $AttachFile->topic_id,
                    'file' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_comments($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // comments
                    $response_details = [];
                    foreach ($Topic->approvedComments as $comment) {
                        $response_details[] = [
                            'id' => $comment->id,
                            'name' => $comment->name,
                            'email' => $comment->email,
                            'date' => $comment->date,
                            'comment' => nl2br($comment->comment),
                            'href' => "/topic/comment/" . $comment->id
                        ];
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Comments of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'comments_count' => count($response_details),
                    'comments' => $response_details
                ];
                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_comment($comment_id, $lang = '')
    {
        if ($comment_id > 0) {

            // Get topic details
            $Comment = Comment::find($comment_id);

            if (count($Comment) > 0) {
                $response_details[] = [
                    'id' => $Comment->id,
                    'name' => $Comment->name,
                    'email' => $Comment->email,
                    'date' => $Comment->date,
                    'comment' => nl2br($Comment->comment)
                ];
                // Response MSG
                $response = [
                    'msg' => 'Comment details',
                    'topic_id' => $Comment->topic_id,
                    'comment' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_related($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // related topics
                    $response_details = [];
                    foreach ($Topic->relatedTopics as $relatedTopic) {
                        $response_details[] = [
                            'id' => $relatedTopic->topic->id,
                            'title' => $relatedTopic->topic->$title_var,
                            'date' => $relatedTopic->topic->date,
                            'href' => "topic/" . $relatedTopic->topic->id,
                            'photo_file' => ($relatedTopic->topic->photo_file != "") ? url("") . "/uploads/topics/" . $relatedTopic->topic->photo_file : null,
                        ];
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Related topics of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'related_topics_count' => count($response_details),
                    'related_topics' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topic_fields($topic_id, $lang = '')
    {
        if ($topic_id > 0) {

            // Get topic details
            $Topics = Topic::where([['id', '=', $topic_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['id', '=', $topic_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $topic_title = "";
                $photo_file = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $topic_title = $Topic->$title_var;
                    $photo_file = $Topic->photo_file;

                    // additional fields
                    $response_details = [];
                    foreach ($Topic->webmasterSection->customFields as $customField) {

                        $cf_saved_val = "";
                        $cf_saved_val_array = array();
                        if (count($Topic->fields) > 0) {
                            foreach ($Topic->fields as $t_field) {
                                if ($t_field->field_id == $customField->id) {
                                    if ($customField->type == 7) {
                                        // if multi check
                                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                                    } else {
                                        $cf_saved_val = $t_field->field_value;
                                    }
                                }
                            }
                        }

                        if (($cf_saved_val != "" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == "$lang")) {
                            $response_details[] = [
                                'type' => $customField->type,
                                'title' => $customField->$title_var,
                                'value' => $cf_saved_val,
                            ];
                        }
                    }

                }
                // Response MSG
                $response = [
                    'msg' => 'Additional Fields of topic',
                    'topic_id' => $topic_id,
                    'topic_title' => $topic_title,
                    'topic_link' => "topic/" . $topic_id,
                    'topic_photo' => ($photo_file != "") ? url("") . "/uploads/topics/" . $photo_file : null,
                    'fields_count' => count($response_details),
                    'fields' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];

            return response()->json($response, 404);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user_topics($user_id, $page_number = 1, $topics_count = 0, $lang = '')
    {
        if ($user_id > 0) {
            if ($page_number < 1) {
                $page_number = 1;
            }
            Paginator::currentPageResolver(function () use ($page_number) {
                return $page_number;
            });

            // Get topics
            $Topics = Topic::where([['created_by', '=', $user_id], ['status',
                1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orWhere([['created_by', '=', $user_id], ['status', 1], ['expire_date', null]])->orderby('row_no', 'asc');

            if ($topics_count > 0) {
                $Topics = $Topics->paginate($topics_count);
            } else {
                $Topics = $Topics->get();
            }

            if (count($Topics) > 0) {
                // By Language
                $lang = $this->getLanguage($lang);
                $title_var = "title_$lang";
                $details_var = "details_ar$lang";
                $user_name = "";

                // Response Details
                $response_details = [];
                foreach ($Topics as $Topic) {
                    $type = $Topic->webmasterSection->type;
                    $section_name = $Topic->webmasterSection->name;
                    $section_id = $Topic->webmasterSection->id;
                    $user_name = $Topic->user->name;


                    $Joined_categories = [];
                    foreach ($Topic->categories as $category) {
                        $Joined_categories[] = [
                            'id' => $category->id,
                            'title' => $category->section->$title_var,
                            'icon' => $category->section->icon,
                            'photo' => ($category->section->photo != "") ? url("") . "/uploads/sections/" . $category->section->photo : null,
                            'href' => "topics/cat/" . $category->id
                        ];
                    }

                    // additional fields
                    $Additional_fields = [];
                    foreach ($Topic->webmasterSection->customFields as $customField) {

                        $cf_saved_val = "";
                        $cf_saved_val_array = array();
                        if (count($Topic->fields) > 0) {
                            foreach ($Topic->fields as $t_field) {
                                if ($t_field->field_id == $customField->id) {
                                    if ($customField->type == 7) {
                                        // if multi check
                                        $cf_saved_val_array = explode(", ", $t_field->field_value);
                                    } else {
                                        $cf_saved_val = $t_field->field_value;
                                    }
                                }
                            }
                        }

                        if (($cf_saved_val != "" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == "$lang")) {
                            $Additional_fields[] = [
                                'type' => $customField->type,
                                'title' => $customField->$title_var,
                                'value' => $cf_saved_val,
                            ];
                        }
                    }

                    $video_file = $Topic->video_file;
                    if ($Topic->video_type == 0) {
                        $video_file = ($Topic->video_file != "") ? url("") . "/uploads/topics/" . $Topic->video_file : "";
                    }

                    $response_details[] = [
                        'id' => $Topic->id,
                        'title' => $Topic->$title_var,
                        'details' => $Topic->$details_var,
                        'date' => $Topic->date,
                        'video_type' => $Topic->video_type,
                        'video_file' => $video_file,
                        'photo_file' => ($Topic->photo_file != "") ? url("") . "/uploads/topics/" . $Topic->photo_file : null,
                        'audio_file' => ($Topic->audio_file != "") ? url("") . "/uploads/topics/" . $Topic->audio_file : null,
                        'icon' => $Topic->icon,
                        'visits' => $Topic->visits,
                        'href' => "topic/" . $Topic->id,
                        'fields_count' => count($Additional_fields),
                        'fields' => $Additional_fields,
                        'Joined_categories_count' => count($Topic->categories),
                        'Joined_categories' => $Joined_categories,
                        'section_id' => $section_id,
                        'section_name' => $section_name,
                        'section_type' => $type,

                    ];

                }
                // Response MSG
                $response = [
                    'msg' => 'List of Topics for user',
                    'user_id' => $user_id,
                    'user_name' => $user_name,
                    'topics_count' => count($Topics),
                    'topics' => $response_details
                ];

                return response()->json($response, 200);
            } else {
                // Empty MSG
                $response = [
                    'msg' => 'There is no data'
                ];

                return response()->json($response, 200);
            }
        } else {
            // Empty MSG
            $response = [
                'msg' => 'There is no data'
            ];
            return response()->json($response, 404);
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
            'api_key' => 'required',
            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_subject' => 'required',
            'contact_message' => 'required'
        ]);

        // check api_key
        if ($request->api_key == Helper::GeneralWebmasterSettings("api_key")) {
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

            // response MSG
            $response = [
                'code' => '1',
                'msg' => 'Message Sent successfully'
            ];
            return response()->json($response, 201);
        } else {
            // Empty MSG
            $response = [
                'code' => '-1',
                'msg' => 'Authentication failed'
            ];
            return response()->json($response, 500);
        }
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
            'api_key' => 'required',
            'subscribe_name' => 'required',
            'subscribe_email' => 'required|email'
        ]);
        // check api_key
        if ($request->api_key == Helper::GeneralWebmasterSettings("api_key")) {
            // General Webmaster Settings
            $WebmasterSettings = WebmasterSetting::find(1);

            $Contacts = Contact::where('email', $request->subscribe_email)->get();
            if (count($Contacts) > 0) {
                // response MSG
                $response = [
                    'code' => '2',
                    'msg' => 'You are already subscribed'
                ];
                return response()->json($response, 200);
            } else {
                $subscribe_names = explode(' ', $request->subscribe_name, 2);

                $Contact = new Contact;
                $Contact->group_id = $WebmasterSettings->newsletter_contacts_group;
                $Contact->first_name = @$subscribe_names[0];
                $Contact->last_name = @$subscribe_names[1];
                $Contact->email = $request->subscribe_email;
                $Contact->status = 1;
                $Contact->save();


                // response MSG
                $response = [
                    'code' => '1',
                    'msg' => 'You have subscribed successfully'
                ];
                return response()->json($response, 201);
            }
        } else {
            // Empty MSG
            $response = [
                'code' => '-1',
                'msg' => 'Authentication failed'
            ];
            return response()->json($response, 500);
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
            'api_key' => 'required',
            'topic_id' => 'required',
            'comment_name' => 'required',
            'comment_email' => 'required|email',
            'comment_message' => 'required'
        ]);

        // check api_key
        if ($request->api_key == Helper::GeneralWebmasterSettings("api_key")) {
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

                // response MSG
                $response = [
                    'code' => '1',
                    'msg' => 'Your Comment Sent successfully'
                ];
                return response()->json($response, 201);
            } else {
                // response MSG
                $response = [
                    'code' => '0',
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 404);
            }
        } else {
            // Empty MSG
            $response = [
                'code' => '-1',
                'msg' => 'Authentication failed'
            ];
            return response()->json($response, 500);
        }
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
            'api_key' => 'required',
            'topic_id' => 'required',
            'order_name' => 'required',
            'order_phone' => 'required',
            'order_email' => 'required|email',
            'order_qty' => 'required'
        ]);

        // check api_key
        if ($request->api_key == Helper::GeneralWebmasterSettings("api_key")) {
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

                // response MSG
                $response = [
                    'code' => '1',
                    'msg' => 'Your Order Sent successfully'
                ];
                return response()->json($response, 201);
            } else {
                // response MSG
                $response = [
                    'code' => '0',
                    'msg' => 'There is no data'
                ];
                return response()->json($response, 404);
            }
        } else {
            // Empty MSG
            $response = [
                'code' => '-1',
                'msg' => 'Authentication failed'
            ];
            return response()->json($response, 500);
        }

    }
}
