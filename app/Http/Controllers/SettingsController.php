<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Setting;
use App\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;

class SettingsController extends Controller
{
    // Define Default Settings ID
    private $id = 1;
    private $uploadPath = "uploads/settings/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    public function edit()
    {
        //

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {
            return view("backEnd.settings.settings", compact("Setting", "GeneralWebmasterSections"));

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
    public function updateSiteInfo(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {

            $Setting->site_title_ar = $request->site_title_ar;
            $Setting->site_title_en = $request->site_title_en;
            $Setting->site_desc_ar = $request->site_desc_ar;
            $Setting->site_desc_en = $request->site_desc_en;
            $Setting->site_keywords_ar = $request->site_keywords_ar;
            $Setting->site_keywords_en = $request->site_keywords_en;
            $Setting->site_webmails = $request->site_webmails;
            $Setting->notify_messages_status = $request->notify_messages_status;
            $Setting->notify_comments_status = $request->notify_comments_status;
            $Setting->notify_orders_status = $request->notify_orders_status;
            $Setting->site_url = $request->site_url;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('infoTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    public function updateSiteStatus(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {

            $Setting->site_status = $request->site_status;
            $Setting->close_msg = $request->close_msg;

            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('statusTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    public function updateSiteStyle(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {

            $this->validate($request, [
                'style_logo_en' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'style_logo_ar' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'style_fav' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'style_apple' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'style_bg_image' => 'mimes:png,jpeg,jpg,gif|max:5000',
                'style_footer_bg' => 'mimes:png,jpeg,jpg,gif|max:5000'
            ]);
            // Start of Upload Files
            $formFileName = "style_logo_en";
            $fileFinalName = "";
            if ($request->$formFileName != "") {
                // Delete a style_logo_en photo
                if ($Setting->style_logo_en != "") {
                    File::delete($this->getUploadPath() . $Setting->style_logo_en);
                }

                $fileFinalName = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName);
            }
            $formFileNameAr = "style_logo_ar";
            $fileFinalNameAr = "";
            if ($request->$formFileNameAr != "") {
                // Delete a style_logo_ar photo
                if ($Setting->style_logo_ar != "") {
                    File::delete($this->getUploadPath() . $Setting->style_logo_ar);
                }

                $fileFinalNameAr = time() . rand(1111,
                        9999) . '.' . $request->file($formFileNameAr)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileNameAr)->move($path, $fileFinalNameAr);
            }

            $formFileName2 = "style_fav";
            $fileFinalName2 = "";
            if ($request->$formFileName2 != "") {
                // Delete a style_fav photo
                if ($Setting->style_fav != "") {
                    File::delete($this->getUploadPath() . $Setting->style_fav);
                }

                $fileFinalName2 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName2)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName2)->move($path, $fileFinalName2);
            }


            $formFileName3 = "style_apple";
            $fileFinalName3 = "";
            if ($request->$formFileName3 != "") {
                // Delete a style_apple photo
                if ($Setting->style_apple != "") {
                    File::delete($this->getUploadPath() . $Setting->style_apple);
                }

                $fileFinalName3 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName3)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName3)->move($path, $fileFinalName3);
            }


            $formFileName4 = "style_bg_image";
            $fileFinalName4 = "";
            if ($request->$formFileName4 != "") {
                // Delete a style_bg_image photo
                if ($Setting->style_bg_image != "") {
                    File::delete($this->getUploadPath() . $Setting->style_bg_image);
                }

                $fileFinalName4 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName4)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName4)->move($path, $fileFinalName4);
            }


            $formFileName5 = "style_footer_bg";
            $fileFinalName5 = "";
            if ($request->$formFileName5 != "") {
                // Delete a style_footer_bg photo
                if ($Setting->style_footer_bg != "") {
                    File::delete($this->getUploadPath() . $Setting->style_footer_bg);
                }

                $fileFinalName5 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName5)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName5)->move($path, $fileFinalName5);
            }

            // End of Upload Files

            if ($fileFinalName != "") {
                $Setting->style_logo_en = $fileFinalName;
            }

            if ($fileFinalNameAr != "") {
                $Setting->style_logo_ar = $fileFinalNameAr;
            }
            if ($fileFinalName2 != "") {
                $Setting->style_fav = $fileFinalName2;
            }
            if ($fileFinalName3 != "") {
                $Setting->style_apple = $fileFinalName3;
            }

            $Setting->style_color1 = $request->style_color1;
            $Setting->style_color2 = $request->style_color2;
            $Setting->style_type = $request->style_type;
            $Setting->style_bg_type = $request->style_bg_type;
            $Setting->style_bg_pattern = $request->style_bg_pattern;
            $Setting->style_bg_color = $request->style_bg_color;
            if ($fileFinalName4 != "") {
                $Setting->style_bg_image = $fileFinalName4;
            }
            $Setting->style_subscribe = $request->style_subscribe;
            $Setting->style_footer = $request->style_footer;
            if ($request->photo_delete == 1) {
                // Delete style_footer_bg
                if ($Setting->style_footer_bg != "") {
                    File::delete($this->getUploadPath() . $Setting->style_footer_bg);
                }

                $Setting->style_footer_bg = "";
            }

            if ($fileFinalName5 != "") {
                $Setting->style_footer_bg = $fileFinalName5;
            }
            $Setting->style_preload = $request->style_preload;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('styleTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    // update tab of site status

    public function getUploadPath()
    {
        return $this->uploadPath;
    }


    // update tab of Style Settings

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    // update tab of social links

    public function updateSocialLinks(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {

            $Setting->social_link1 = $request->social_link1;
            $Setting->social_link2 = $request->social_link2;
            $Setting->social_link3 = $request->social_link3;
            $Setting->social_link4 = $request->social_link4;
            $Setting->social_link5 = $request->social_link5;
            $Setting->social_link6 = $request->social_link6;
            $Setting->social_link7 = $request->social_link7;
            $Setting->social_link8 = $request->social_link8;
            $Setting->social_link9 = $request->social_link9;
            $Setting->social_link10 = $request->social_link10;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('socialTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }

    // update tab of contacts
    public function updateContacts(Request $request)
    {
        //
        $id = $this->getId();
        $Setting = Setting::find($id);
        if (count($Setting) > 0) {

            $Setting->contact_t1_ar = $request->contact_t1_ar;
            $Setting->contact_t1_en = $request->contact_t1_en;
            $Setting->contact_t3 = $request->contact_t3;
            $Setting->contact_t4 = $request->contact_t4;
            $Setting->contact_t5 = $request->contact_t5;
            $Setting->contact_t6 = $request->contact_t6;
            $Setting->contact_t7_ar = $request->contact_t7_ar;
            $Setting->contact_t7_en = $request->contact_t7_en;
            $Setting->updated_by = Auth::user()->id;
            $Setting->save();
            return redirect()->action('SettingsController@edit')
                ->with('doneMessage', trans('backLang.saveDone'))
                ->with('contactsTab', 'active');
        } else {
            return redirect()->route('adminHome');
        }
    }
}
