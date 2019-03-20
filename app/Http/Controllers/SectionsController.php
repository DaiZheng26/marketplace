<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Section;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class SectionsController extends Controller
{
    private $uploadPath = "uploads/sections/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function index($webmasterId)
    {
        // Check Permissions
        $data_sections_arr = explode(",", Auth::user()->permissionsGroup->data_sections);
        if (!in_array($webmasterId, $data_sections_arr)) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Webmaster Section Details
        $WebmasterSection = WebmasterSection::find($webmasterId);

        if (@Auth::user()->permissionsGroup->view_status) {
            $Sections = Section::where('created_by', '=', Auth::user()->id)->where('webmaster_id', '=',
                $webmasterId)->where('father_id', '=', '0')->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $Sections = Section::where('webmaster_id', '=', $webmasterId)->where('father_id', '=',
                '0')->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("backEnd.sections", compact("Sections", "GeneralWebmasterSections", "WebmasterSection"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function create($webmasterId)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Webmaster Section Details
        $WebmasterSection = WebmasterSection::find($webmasterId);

        $fatherSections = Section::where('webmaster_id', '=', $webmasterId)->where('father_id', '=',
            '0')->orderby('row_no', 'asc')->get();

        return view("backEnd.sections.create",
            compact("GeneralWebmasterSections", "WebmasterSection", "fatherSections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $webmasterId)
    {
        //
        $this->validate($request, [
            'photo' => 'mimes:png,jpeg,jpg,gif|max:3000'
        ]);


        $next_nor_no = Section::where('webmaster_id', '=', $webmasterId)->where('father_id', '=',
            $request->father_id)->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        // Start of Upload Files
        $formFileName = "photo";
        $fileFinalName = "";
        if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName);
        }
        // End of Upload Files

        $Section = new Section;
        $Section->row_no = $next_nor_no;
        $Section->title_ar = $request->title_ar;
        $Section->title_en = $request->title_en;
        $Section->icon = $request->icon;
        if ($fileFinalName != "") {
            $Section->photo = $fileFinalName;
        }
        $Section->webmaster_id = $webmasterId;
        $Section->father_id = $request->father_id;
        $Section->visits = 0;
        $Section->status = 1;
        $Section->created_by = Auth::user()->id;


        // Meta title
        $Section->seo_title_ar = $request->title_ar;
        $Section->seo_title_en = $request->title_en;

        //URL Slugs
        $slugs = Helper::URLSlug($request->title_ar, $request->title_en, "category", 0);
        $Section->seo_url_slug_ar = $slugs['slug_ar'];
        $Section->seo_url_slug_en = $slugs['slug_en'];


        $Section->save();

        return redirect()->action('SectionsController@index', $webmasterId)->with('doneMessage',
            trans('backLang.addDone'));
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
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function edit($webmasterId, $id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Sections = Section::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Sections = Section::find($id);
        }
        if (count($Sections) > 0) {
            //Section Sections Details
            $WebmasterSection = WebmasterSection::find($Sections->webmaster_id);

            $fatherSections = Section::where('webmaster_id', '=', $webmasterId)->where('id', '!=',
                $id)->where('father_id', '=', '0')->orderby('row_no', 'asc')->get();

            return view("backEnd.sections.edit",
                compact("Sections", "GeneralWebmasterSections", "WebmasterSection", "fatherSections"));
        } else {
            return redirect()->action('SectionsController@index', $webmasterId);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $webmasterId, $id)
    {
        //
        $Section = Section::find($id);
        if (count($Section) > 0) {


            $this->validate($request, [
                'photo' => 'mimes:png,jpeg,jpg,gif|max:3000'
            ]);


            // Start of Upload Files
            $formFileName = "photo";
            $fileFinalName = "";
            if ($request->$formFileName != "") {
                // Delete a Section photo
                if ($Section->photo != "") {
                    File::delete($this->getUploadPath() . $Section->photo);
                }

                $fileFinalName = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName);
            }
            // End of Upload Files

            $Section->title_ar = $request->title_ar;
            $Section->title_en = $request->title_en;
            $Section->icon = $request->icon;
            if ($request->photo_delete == 1) {
                // Delete photo
                if ($Section->photo != "") {
                    File::delete($this->getUploadPath() . $Section->photo);
                }

                $Section->photo = "";
            }

            if ($fileFinalName != "") {
                $Section->photo = $fileFinalName;
            }
            $Section->father_id = $request->father_id;
            $Section->status = $request->status;
            $Section->updated_by = Auth::user()->id;
            $Section->save();
            return redirect()->action('SectionsController@edit', [$webmasterId, $id])->with('doneMessage',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('SectionsController@index', $webmasterId);
        }
    }

    public function seo(Request $request, $webmasterId, $id)
    {
        //
        $Section = Section::find($id);
        if (count($Section) > 0) {

            $Section->seo_title_ar = $request->seo_title_ar;
            $Section->seo_title_en = $request->seo_title_en;
            $Section->seo_description_ar = $request->seo_description_ar;
            $Section->seo_description_en = $request->seo_description_en;
            $Section->seo_keywords_ar = $request->seo_keywords_ar;
            $Section->seo_keywords_en = $request->seo_keywords_en;
            $Section->updated_by = Auth::user()->id;

            //URL Slugs
            $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "category", $id);
            $Section->seo_url_slug_ar = $slugs['slug_ar'];
            $Section->seo_url_slug_en = $slugs['slug_en'];

            $Section->save();
            return redirect()->action('SectionsController@edit', [$webmasterId, $id])->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'seo');
        } else {
            return redirect()->action('SectionsController@index', $webmasterId);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public function destroy($webmasterId, $id)
    {
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Sections = Section::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Section = Section::find($id);
        }

        if (count($Section) > 0) {
            // Delete a Section photo
            if ($Section->photo != "") {
                File::delete($this->getUploadPath() . $Section->photo);
            }
            Section::where('father_id', $Section->id)->delete();
            $Section->delete();
            return redirect()->action('SectionsController@index', $webmasterId)->with('doneMessage',
                trans('backLang.deleteDone'));
        } else {
            return redirect()->action('SectionsController@index', $webmasterId);
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request, $webmasterId)
    {
        //
        if ($request->action == "order") {
            foreach ($request->row_ids as $rowId) {
                $Section = Section::find($rowId);
                if (count($Section) > 0) {
                    $row_no_val = "row_no_" . $rowId;
                    $Section->row_no = $request->$row_no_val;
                    $Section->save();
                }
            }

        } elseif ($request->action == "activate") {
            Section::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            Section::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            // Delete Sections photo
            $Sections = Section::wherein('id', $request->ids)->get();
            foreach ($Sections as $Section) {
                if ($Section->photo != "") {
                    File::delete($this->getUploadPath() . $Section->photo);
                }
            }
            Section::wherein('father_id', $request->ids)->delete();
            Section::wherein('id', $request->ids)
                ->delete();

        }
        return redirect()->action('SectionsController@index', $webmasterId)->with('doneMessage',
            trans('backLang.saveDone'));
    }


}
