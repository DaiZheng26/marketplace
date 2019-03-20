<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\WebmasterBanner;
use App\WebmasterSection;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class WebmasterBannersController extends Controller
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
            $WebmasterBanners = WebmasterBanner::where('created_by', '=', Auth::user()->id)->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $WebmasterBanners = WebmasterBanner::orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("backEnd.webmaster.banners", compact("WebmasterBanners", "GeneralWebmasterSections"));
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

        return view("backEnd.webmaster.banners.create", compact("GeneralWebmasterSections"));
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

        $next_nor_no = WebmasterBanner::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }
        $WebmasterBanner = new WebmasterBanner;
        $WebmasterBanner->row_no = $next_nor_no;
        $WebmasterBanner->name = $request->name;
        $WebmasterBanner->width = $request->width;
        $WebmasterBanner->height = $request->height;
        $WebmasterBanner->desc_status = $request->desc_status;
        $WebmasterBanner->link_status = $request->link_status;
        $WebmasterBanner->icon_status = $request->icon_status;
        $WebmasterBanner->type = $request->type;
        $WebmasterBanner->status = 1;
        $WebmasterBanner->created_by = Auth::user()->id;
        $WebmasterBanner->save();

        return redirect()->action('WebmasterBannersController@index')->with('doneMessage', trans('backLang.addDone'));
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
            $WebmasterBanners = WebmasterBanner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterBanners = WebmasterBanner::find($id);
        }
        if (count($WebmasterBanners) > 0) {
            return view("backEnd.webmaster.banners.edit", compact("WebmasterBanners", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('WebmasterBannersController@index');
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
        $WebmasterBanner = WebmasterBanner::find($id);
        if (count($WebmasterBanner) > 0) {
            $WebmasterBanner->name = $request->name;
            $WebmasterBanner->width = $request->width;
            $WebmasterBanner->height = $request->height;
            $WebmasterBanner->desc_status = $request->desc_status;
            $WebmasterBanner->link_status = $request->link_status;
            $WebmasterBanner->icon_status = $request->icon_status;
            $WebmasterBanner->type = $request->type;
            $WebmasterBanner->status = $request->status;
            $WebmasterBanner->updated_by = Auth::user()->id;
            $WebmasterBanner->save();
            return redirect()->action('WebmasterBannersController@index', $id)->with('doneMessage',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('WebmasterBannersController@index');
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
            $WebmasterBanner = WebmasterBanner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterBanner = WebmasterBanner::find($id);
        }
        if (count($WebmasterBanner) > 0) {
            $WebmasterBanner->delete();
            return redirect()->action('WebmasterBannersController@index')->with('doneMessage',
                trans('backLang.deleteDone'));
        } else {
            return redirect()->action('WebmasterBannersController@index');
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
                $WebmasterBanner = WebmasterBanner::find($rowId);
                if (count($WebmasterBanner) > 0) {
                    $row_no_val = "row_no_" . $rowId;
                    $WebmasterBanner->row_no = $request->$row_no_val;
                    $WebmasterBanner->save();
                }
            }

        } elseif ($request->action == "activate") {
            WebmasterBanner::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            WebmasterBanner::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            WebmasterBanner::wherein('id', $request->ids)
                ->delete();

        }
        return redirect()->action('WebmasterBannersController@index')->with('doneMessage', trans('backLang.saveDone'));
    }


}