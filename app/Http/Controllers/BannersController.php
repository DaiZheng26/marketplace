<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests;
use App\WebmasterBanner;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;

class BannersController extends Controller
{

    private $uploadPath = "uploads/banners/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->banners_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Banners Sections
        $WebmasterBanners = WebmasterBanner::where('status', '=', '1')->orderby('row_no', 'asc')->get();

        if (@Auth::user()->permissionsGroup->view_status) {
            $Banners = Banner::where('created_by', '=', Auth::user()->id)->orderby('section_id',
                'asc')->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $Banners = Banner::orderby('section_id', 'asc')->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("backEnd.banners", compact("Banners", "GeneralWebmasterSections", "WebmasterBanners"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sectionId)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Banner Sections Details
        $WebmasterBanner = WebmasterBanner::find($sectionId);

        return view("backEnd.banners.create", compact("GeneralWebmasterSections", "WebmasterBanner"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        $this->validate($request, [
            'file2_ar' => 'mimes:mp4,ogv,webm',
            'file2_en' => 'mimes:mp4,ogv,webm',
            'file_ar' => 'mimes:png,jpeg,jpg,gif|max:3000',
            'file_en' => 'mimes:png,jpeg,jpg,gif|max:3000'
        ]);


        $next_nor_no = Banner::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        // Start of Upload Files
        $formFileName = "file_ar";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        $formFileName = "file_en";
        $fileFinalName_en = "";
        if ($request->$formFileName != "") {
            $fileFinalName_en = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_en);
        }
        if ($fileFinalName_ar == "") {
            $formFileName = "file2_ar";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
        }
        if ($fileFinalName_en == "") {
            $formFileName = "file2_en";
            $fileFinalName_en = "";
            if ($request->$formFileName != "") {
                $fileFinalName_en = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_en);
            }
        }
        // End of Upload Files

        $Banner = new Banner;
        $Banner->row_no = $next_nor_no;
        $Banner->section_id = $request->section_id;
        $Banner->title_ar = $request->title_ar;
        $Banner->title_en = $request->title_en;
        $Banner->details_ar = $request->details_ar;
        $Banner->details_en = $request->details_en;
        $Banner->code = $request->code;
        $Banner->file_ar = $fileFinalName_ar;
        $Banner->file_en = $fileFinalName_en;
        $Banner->icon = $request->icon;
        $Banner->video_type = $request->video_type;
        if ($request->video_type == 2) {
            $Banner->youtube_link = $request->vimeo_link;
        } else {
            $Banner->youtube_link = $request->youtube_link;
        }
        $Banner->link_url = $request->link_url;
        $Banner->visits = 0;
        $Banner->status = 1;
        $Banner->created_by = Auth::user()->id;
        $Banner->save();

        return redirect()->action('BannersController@index')->with('doneMessage', trans('backLang.addDone'));
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->edit_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Banners = Banner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Banners = Banner::find($id);
        }
        if (count($Banners) > 0) {
            //Banner Sections Details
            $WebmasterBanner = WebmasterBanner::find($Banners->section_id);

            return view("backEnd.banners.edit", compact("Banners", "GeneralWebmasterSections", "WebmasterBanner"));
        } else {
            return redirect()->action('BannersController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        $Banner = Banner::find($id);
        if (count($Banner) > 0) {


            $this->validate($request, [
                'file2_ar' => 'mimes:mp4,ogv,webm',
                'file2_en' => 'mimes:mp4,ogv,webm',
                'file_ar' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'file_en' => 'mimes:png,jpeg,jpg,gif|max:3000'
            ]);


            // Start of Upload Files
            $formFileName = "file_ar";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            $formFileName = "file_en";
            $fileFinalName_en = "";
            if ($request->$formFileName != "") {
                $fileFinalName_en = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_en);
            }
            if ($fileFinalName_ar == "") {
                $formFileName = "file2_ar";
                $fileFinalName_ar = "";
                if ($request->$formFileName != "") {
                    $fileFinalName_ar = time() . rand(1111,
                            9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->getUploadPath();
                    $request->file($formFileName)->move($path, $fileFinalName_ar);
                }
            }
            if ($fileFinalName_en == "") {
                $formFileName = "file2_en";
                $fileFinalName_en = "";
                if ($request->$formFileName != "") {
                    $fileFinalName_en = time() . rand(1111,
                            9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->getUploadPath();
                    $request->file($formFileName)->move($path, $fileFinalName_en);
                }
            }
            // End of Upload Files

            $Banner->section_id = $request->section_id;
            $Banner->title_ar = $request->title_ar;
            $Banner->title_en = $request->title_en;
            $Banner->details_ar = $request->details_ar;
            $Banner->details_en = $request->details_en;
            $Banner->code = $request->code;

            if ($fileFinalName_ar != "") {
                // Delete a banner file
                if ($Banner->file_ar != "") {
                    File::delete($this->getUploadPath() . $Banner->file_ar);
                }

                $Banner->file_ar = $fileFinalName_ar;
            }
            if ($fileFinalName_en != "") {
                if ($Banner->file_en != "") {
                    File::delete($this->getUploadPath() . $Banner->file_en);
                }
                $Banner->file_en = $fileFinalName_en;
            }
            $Banner->video_type = $request->video_type;
            if ($request->video_type == 2) {
                $Banner->youtube_link = $request->vimeo_link;
            } else {
                $Banner->youtube_link = $request->youtube_link;
            }
            $Banner->link_url = $request->link_url;
            $Banner->icon = $request->icon;
            $Banner->status = $request->status;
            $Banner->updated_by = Auth::user()->id;
            $Banner->save();
            return redirect()->action('BannersController@edit', $id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('BannersController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->delete_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Banner = Banner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Banner = Banner::find($id);
        }
        if (count($Banner) > 0) {
            // Delete a banner file
            if ($Banner->file_ar != "") {
                File::delete($this->getUploadPath() . $Banner->file_ar);
            }
            if ($Banner->file_en != "") {
                File::delete($this->getUploadPath() . $Banner->file_en);
            }

            $Banner->delete();
            return redirect()->action('BannersController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('BannersController@index');
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[]
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        //
        if ($request->action == "order") {
            foreach ($request->row_ids as $rowId) {
                $Banner = Banner::find($rowId);
                if (count($Banner) > 0) {
                    $row_no_val = "row_no_" . $rowId;
                    $Banner->row_no = $request->$row_no_val;
                    $Banner->save();
                }
            }

        } elseif ($request->action == "activate") {
            Banner::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            Banner::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->delete_status) {
                return Redirect::to(route('NoPermission'))->send();
            }
            // Delete banners files
            $Banners = Banner::wherein('id', $request->ids)->get();
            foreach ($Banners as $banner) {
                if ($banner->file_ar != "") {
                    File::delete($this->getUploadPath() . $banner->file_ar);
                }
                if ($banner->file_en != "") {
                    File::delete($this->getUploadPath() . $banner->file_en);
                }
            }

            Banner::wherein('id', $request->ids)
                ->delete();

        }
        return redirect()->action('BannersController@index')->with('doneMessage', trans('backLang.saveDone'));
    }


}