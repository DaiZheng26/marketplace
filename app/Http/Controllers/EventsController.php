<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
        }
        $DefaultDate = date('Y-m-d');
        $EStatus = "";

        return view("backEnd.calendar", compact("GeneralWebmasterSections", "Events", "DefaultDate", "EStatus"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
        }
        $DefaultDate = date('Y-m-d');
        $EStatus = "new";

        return view("backEnd.calendar", compact("GeneralWebmasterSections", "Events", "DefaultDate", "EStatus"));
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
        $this->validate($request, [
            'type' => 'required',
            'title' => 'required'
        ]);

        $Event = new Event;
        $Event->user_id = Auth::user()->id;
        $Event->created_by = Auth::user()->id;
        $Event->type = $request->type;
        $Event->title = $request->title;
        $Event->details = $request->details;
        if ($request->type == 3) {
            // Task
            $Event->start_date = date('Y-m-d', strtotime($request->date_start));
            $Event->end_date = date('Y-m-d', strtotime($request->date_end));
        } elseif ($request->type == 2) {
            // Event
            $Event->start_date = date('Y-m-d H:i:s', strtotime($request->time_start));
            $Event->end_date = date('Y-m-d H:i:s', strtotime($request->time_end));
        } elseif ($request->type == 1) {
            // Meeting
            $Event->start_date = date('Y-m-d H:i:s', strtotime($request->date_at));
            $Event->end_date = date('Y-m-d H:i:s', strtotime($request->date_at));
        } else {
            // Note
            $Event->start_date = date('Y-m-d', strtotime($request->date));
            $Event->end_date = date('Y-m-d', strtotime($request->date));
        }
        $Event->save();

        return redirect()->action('EventsController@index')->with('doneMessage', trans('backLang.addDone'));
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

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
            $EditEvent = Event::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
            $EditEvent = Event::find($id);
        }

        if (count($EditEvent) > 0) {
            $DefaultDate = date('Y-m-d', strtotime($EditEvent->start_date));
            $EStatus = "edit";
            return view("backEnd.calendar",
                compact("GeneralWebmasterSections", "Events", "EditEvent", "DefaultDate", "EStatus"));
        } else {
            return redirect()->action('EventsController@index');
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
        $Event = Event::find($id);
        if (count($Event) > 0) {

            $this->validate($request, [
                'type' => 'required',
                'title' => 'required'
            ]);

            $Event->type = $request->type;
            $Event->title = $request->title;
            $Event->details = $request->details;
            if ($request->type == 3) {
                // Task
                $Event->start_date = date('Y-m-d', strtotime($request->date_start));
                $Event->end_date = date('Y-m-d', strtotime($request->date_end));
            } elseif ($request->type == 2) {
                // Event
                $Event->start_date = date('Y-m-d H:i:s', strtotime($request->time_start));
                $Event->end_date = date('Y-m-d H:i:s', strtotime($request->time_end));
            } elseif ($request->type == 1) {
                // Meeting
                $Event->start_date = date('Y-m-d H:i:s', strtotime($request->date_at));
                $Event->end_date = date('Y-m-d H:i:s', strtotime($request->date_at));
            } else {
                // Note
                $Event->start_date = date('Y-m-d', strtotime($request->date));
                $Event->end_date = date('Y-m-d', strtotime($request->date));
            }
            $Event->updated_by = Auth::user()->id;
            $Event->save();
            return redirect()->action('EventsController@index', $id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('EventsController@index');
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
            $Event = Event::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Event = Event::find($id);
        }
        if (count($Event) > 0) {
            $Event->delete();
            return redirect()->action('EventsController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('EventsController@index');
        }
    }


    /**
     * Update all resources in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAll()
    {
        //
        Event::where('user_id', "=", Auth::user()->id)->delete();
        return redirect()->action('EventsController@index')->with('doneMessage', trans('backLang.saveDone'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function extend(Request $request, $id)
    {
        //
        $Event = Event::find($id);
        if (count($Event) > 0) {
            if ($request->started_on != "") {
                $Event->start_date = date('Y-m-d H:i:s', strtotime($request->started_on));
            }
            if ($request->ended_on != "") {
                $Event->end_date = date('Y-m-d', strtotime($request->ended_on));
            }
            $Event->updated_by = Auth::user()->id;
            $Event->save();
        }
    }

}
