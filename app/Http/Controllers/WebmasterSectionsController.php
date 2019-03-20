<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permissions;
use App\WebmasterSection;
use App\WebmasterSectionField;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class WebmasterSectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0) {
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
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmasterSections = WebmasterSection::where('created_by', '=', Auth::user()->id)->orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $WebmasterSections = WebmasterSection::orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("backEnd.webmaster.sections", compact("WebmasterSections", "GeneralWebmasterSections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        return view("backEnd.webmaster.sections.create", compact("GeneralWebmasterSections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $next_nor_no = WebmasterSection::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }
        $WebmasterSection = new WebmasterSection;
        $WebmasterSection->row_no = $next_nor_no;
        $WebmasterSection->name = $request->name;
        $WebmasterSection->type = $request->type;
        $WebmasterSection->sections_status = $request->sections_status;
        $WebmasterSection->comments_status = $request->comments_status;
        $WebmasterSection->date_status = $request->date_status;
        $WebmasterSection->expire_date_status = $request->expire_date_status;
        $WebmasterSection->longtext_status = $request->longtext_status;
        $WebmasterSection->editor_status = $request->editor_status;
        $WebmasterSection->attach_file_status = $request->attach_file_status;
        $WebmasterSection->extra_attach_file_status = $request->extra_attach_file_status;
        $WebmasterSection->multi_images_status = $request->multi_images_status;
        $WebmasterSection->maps_status = $request->maps_status;
        $WebmasterSection->order_status = $request->order_status;
        $WebmasterSection->section_icon_status = $request->section_icon_status;
        $WebmasterSection->icon_status = $request->icon_status;
        $WebmasterSection->related_status = $request->related_status;
        $WebmasterSection->status = 1;
        $WebmasterSection->created_by = Auth::user()->id;

        //URL Slugs
        $slugs = Helper::URLSlug($request->name, $request->name, "section", 0);
        $WebmasterSection->seo_url_slug_ar = $slugs['slug_ar'];
        $WebmasterSection->seo_url_slug_en = $slugs['slug_en'];


        $WebmasterSection->save();

        $Permissions = Permissions::find(Auth::user()->permissionsGroup->id);
        if (count($Permissions) > 0) {
            $Permissions->data_sections = $Permissions->data_sections . "," . $WebmasterSection->id;
            $Permissions->save();
        }
        if (Auth::user()->permissionsGroup->id != 1) {
            $Permissions = Permissions::find(1);
            if (count($Permissions) > 0) {
                $Permissions->data_sections = $Permissions->data_sections . "," . $WebmasterSection->id;
                $Permissions->save();
            }
        }

        return redirect()->action('WebmasterSectionsController@index')->with('doneMessage', trans('backLang.addDone'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmasterSections = WebmasterSection::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterSections = WebmasterSection::find($id);
        }
        if (count($WebmasterSections) > 0) {
            return view("backEnd.webmaster.sections.edit", compact("WebmasterSections", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('WebmasterSectionsController@index');
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
        //
        $WebmasterSection = WebmasterSection::find($id);
        if (count($WebmasterSection) > 0) {
            $WebmasterSection->name = $request->name;
            $WebmasterSection->type = $request->type;
            $WebmasterSection->sections_status = $request->sections_status;
            $WebmasterSection->comments_status = $request->comments_status;
            $WebmasterSection->date_status = $request->date_status;
            $WebmasterSection->expire_date_status = $request->expire_date_status;
            $WebmasterSection->longtext_status = $request->longtext_status;
            $WebmasterSection->editor_status = $request->editor_status;
            $WebmasterSection->attach_file_status = $request->attach_file_status;
            $WebmasterSection->extra_attach_file_status = $request->extra_attach_file_status;
            $WebmasterSection->multi_images_status = $request->multi_images_status;
            $WebmasterSection->maps_status = $request->maps_status;
            $WebmasterSection->order_status = $request->order_status;
            $WebmasterSection->section_icon_status = $request->section_icon_status;
            $WebmasterSection->icon_status = $request->icon_status;
            $WebmasterSection->related_status = $request->related_status;
            $WebmasterSection->status = $request->status;
            $WebmasterSection->updated_by = Auth::user()->id;
            $WebmasterSection->save();
            return redirect()->action('WebmasterSectionsController@edit', $id)->with('doneMessage',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('WebmasterSectionsController@index');
        }
    }


    public function seo(Request $request, $id)
    {
        //
        $WebmasterSection = WebmasterSection::find($id);
        if (count($WebmasterSection) > 0) {

            $WebmasterSection->seo_title_ar = $request->seo_title_ar;
            $WebmasterSection->seo_title_en = $request->seo_title_en;
            $WebmasterSection->seo_description_ar = $request->seo_description_ar;
            $WebmasterSection->seo_description_en = $request->seo_description_en;
            $WebmasterSection->seo_keywords_ar = $request->seo_keywords_ar;
            $WebmasterSection->seo_keywords_en = $request->seo_keywords_en;
            $WebmasterSection->updated_by = Auth::user()->id;

            //URL Slugs
            $slugs = Helper::URLSlug($request->seo_url_slug_ar, $request->seo_url_slug_en, "section", $id);
            $WebmasterSection->seo_url_slug_ar = $slugs['slug_ar'];
            $WebmasterSection->seo_url_slug_en = $slugs['slug_en'];

            $WebmasterSection->save();
            return redirect()->action('WebmasterSectionsController@edit', $id)->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'seo');
        } else {
            return redirect()->action('SectionsController@index');
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
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmasterSection = WebmasterSection::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterSection = WebmasterSection::find($id);
        }
        if (count($WebmasterSection) > 0) {

            //delete additional fields
            WebmasterSectionField::where('webmaster_id', $WebmasterSection->id)->delete();
            //delete section
            $WebmasterSection->delete();
            return redirect()->action('WebmasterSectionsController@index')->with('doneMessage',
                trans('backLang.deleteDone'));
        } else {
            return redirect()->action('WebmasterSectionsController@index');
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
                $WebmasterSection = WebmasterSection::find($rowId);
                if (count($WebmasterSection) > 0) {
                    $row_no_val = "row_no_" . $rowId;
                    $WebmasterSection->row_no = $request->$row_no_val;
                    $WebmasterSection->save();
                }
            }

        } elseif ($request->action == "activate") {
            WebmasterSection::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            WebmasterSection::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            //delete additional fields
            WebmasterSectionField::wherein('webmaster_id', $request->ids)->delete();
            //delete section
            WebmasterSection::wherein('id', $request->ids)
                ->delete();

        }
        return redirect()->action('WebmasterSectionsController@index')->with('doneMessage', trans('backLang.saveDone'));
    }



// Fields Functions

    /**
     * Show all Fields.
     *
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function webmasterFields($webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsCreate($webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab',
                'fields')->with('fieldST', 'create');
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsStore(Request $request, $webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            //
            $this->validate($request, [
                'type' => 'required'
            ]);

            $next_nor_no = WebmasterSectionField::where('webmaster_id', '=', $webmasterId)->max('row_no');
            if ($next_nor_no < 1) {
                $next_nor_no = 1;
            } else {
                $next_nor_no++;
            }

            $WebmasterSectionField = new WebmasterSectionField;
            $WebmasterSectionField->webmaster_id = $webmasterId;
            $WebmasterSectionField->row_no = $next_nor_no;
            $WebmasterSectionField->title_ar = $request->title_ar;
            $WebmasterSectionField->title_en = $request->title_en;
            $WebmasterSectionField->default_value = $request->default_value;
            $WebmasterSectionField->details_ar = $request->details_ar;
            $WebmasterSectionField->details_en = $request->details_en;
            $WebmasterSectionField->lang_code = $request->lang_code;
            $WebmasterSectionField->type = $request->type;
            $WebmasterSectionField->required = $request->required;
            $WebmasterSectionField->status = 1;
            $WebmasterSectionField->created_by = Auth::user()->id;
            $WebmasterSectionField->save();

            return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'fields');

        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $webmasterId
     * @param  int $field_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsEdit($webmasterId, $field_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            $WebmasterSectionField = WebmasterSectionField::find($field_id);
            if (count($WebmasterSectionField) > 0) {
                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab',
                    'fields')->with('fieldST', 'edit')->with('WebmasterSectionField', $WebmasterSectionField);
            } else {
                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $webmasterId
     * @param  int $file_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsUpdate(Request $request, $webmasterId, $file_id)
    {

        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            //

            $WebmasterSectionField = WebmasterSectionField::find($file_id);
            if (count($WebmasterSectionField) > 0) {

                $WebmasterSectionField->title_ar = $request->title_ar;
                $WebmasterSectionField->title_en = $request->title_en;
                $WebmasterSectionField->default_value = $request->default_value;
                $WebmasterSectionField->details_ar = $request->details_ar;
                $WebmasterSectionField->details_en = $request->details_en;
                $WebmasterSectionField->lang_code = $request->lang_code;
                $WebmasterSectionField->type = $request->type;
                $WebmasterSectionField->required = $request->required;
                $WebmasterSectionField->status = $request->status;
                $WebmasterSectionField->updated_by = Auth::user()->id;
                $WebmasterSectionField->save();

                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                    trans('backLang.saveDone'))->with('activeTab', 'fields');
            } else {
                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $webmasterId
     * @param  int $file_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsDestroy($webmasterId, $file_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            $WebmasterSectionField = WebmasterSectionField::find($file_id);
            if (count($WebmasterSectionField) > 0) {
                $WebmasterSectionField->delete();
                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                    trans('backLang.deleteDone'))->with('activeTab', 'fields');
            } else {
                return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsUpdateAll(Request $request, $webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (count($WebmasterSection) > 0) {
            //
            if ($request->action == "order") {
                foreach ($request->row_ids as $rowId) {
                    $WebmasterSectionField = WebmasterSectionField::find($rowId);
                    if (count($WebmasterSectionField) > 0) {
                        $row_no_val = "row_no_" . $rowId;
                        $WebmasterSectionField->row_no = $request->$row_no_val;
                        $WebmasterSectionField->save();
                    }
                }
            } elseif ($request->action == "activate") {
                WebmasterSectionField::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                WebmasterSectionField::wherein('id', $request->ids)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {

                WebmasterSectionField::wherein('id', $request->ids)
                    ->delete();

            }
            return redirect()->action('WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                trans('backLang.saveDone'))->with('activeTab', 'fields');
        } else {
            return redirect()->route('NotFound');
        }
    }


}
