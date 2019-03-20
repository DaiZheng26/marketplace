<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\WebmasterSection;
use App\WebmasterSetting;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use App\Menu;
use App\Permissions;
use App\WebmasterBanner;
use App\ContactsGroup;
use App\Topic;

class WebmasterSettingsController extends Controller
{
    // Define Default Settings ID
    private $id = 1;

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    public function edit()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $ParentMenus = Menu::where('father_id', '0')->orderby('row_no', 'asc')->get();
        $WebmasterBanners = WebmasterBanner::orderby('row_no', 'asc')->get();
        $ContactsGroups = ContactsGroup::orderby('id', 'asc')->get();
        $PermissionsGroups = Permissions::orderby('id', 'asc')->get();
        $SitePages = Topic::where('webmaster_id', 1)->orderby('row_no', 'asc')->get();

        $id = $this->getId();
        $WebmasterSetting = WebmasterSetting::find($id);
        if (count($WebmasterSetting) > 0) {
            return view("backEnd.webmaster.settings", compact("WebmasterSetting", "GeneralWebmasterSections","ParentMenus","WebmasterBanners","ContactsGroups","SitePages","PermissionsGroups"));

        } else {
            return redirect()->route('adminHome');
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id = 1 for default settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $this->getId();
        $WebmasterSetting = WebmasterSetting::find($id);
        if (count($WebmasterSetting) > 0) {
            $WebmasterSetting->ar_box_status = $request->ar_box_status;
            $WebmasterSetting->en_box_status = $request->en_box_status;
            $WebmasterSetting->seo_status = $request->seo_status;
            $WebmasterSetting->analytics_status = $request->analytics_status;
            $WebmasterSetting->banners_status = $request->banners_status;
            $WebmasterSetting->inbox_status = $request->inbox_status;
            $WebmasterSetting->calendar_status = $request->calendar_status;
            $WebmasterSetting->settings_status = $request->settings_status;
            $WebmasterSetting->newsletter_status = $request->newsletter_status;
            $WebmasterSetting->members_status =  0; //$request->orders_status;
            $WebmasterSetting->orders_status = 0; //$request->orders_status;
            $WebmasterSetting->shop_status = 0; //$request->shop_status;
            $WebmasterSetting->shop_settings_status = 0; //$request->shop_settings_status;
            $WebmasterSetting->default_currency_id = 0; //$request->default_currency_id;
            $WebmasterSetting->languages_count = $request->languages_count;
            $WebmasterSetting->header_menu_id = $request->header_menu_id;
            $WebmasterSetting->footer_menu_id = $request->footer_menu_id;
            $WebmasterSetting->home_banners_section_id = $request->home_banners_section_id;
            $WebmasterSetting->home_text_banners_section_id = $request->home_text_banners_section_id;
            $WebmasterSetting->side_banners_section_id = $request->side_banners_section_id;
            $WebmasterSetting->contact_page_id = $request->contact_page_id;
            $WebmasterSetting->newsletter_contacts_group = $request->newsletter_contacts_group;
            $WebmasterSetting->new_comments_status = $request->new_comments_status;
            $WebmasterSetting->links_status = $request->links_status;
            $WebmasterSetting->register_status = $request->register_status;
            $WebmasterSetting->permission_group = $request->permission_group;
            $WebmasterSetting->api_status = $request->api_status;
            $WebmasterSetting->api_key = $request->api_key;
            $WebmasterSetting->home_content1_section_id = $request->home_content1_section_id;
            $WebmasterSetting->home_content2_section_id = $request->home_content2_section_id;
            $WebmasterSetting->home_content3_section_id = $request->home_content3_section_id;
            $WebmasterSetting->latest_news_section_id = $request->latest_news_section_id;
            $WebmasterSetting->updated_by =  Auth::user()->id;
            $WebmasterSetting->save();
            return redirect()->action('WebmasterSettingsController@edit')->with('doneMessage',
                trans('backLang.saveDone'));
        } else {
            return redirect()->route('adminHome');
        }
    }
}