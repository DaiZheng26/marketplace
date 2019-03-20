<?php

namespace App\Http\Controllers;

use App\AnalyticsPage;
use App\AnalyticsVisitor;
use App\Contact;
use App\Event;
use App\Http\Requests;
use App\Section;
use App\Topic;
use App\Webmail;
use App\WebmasterSection;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            //List of all Webmails
            $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')
                ->where('cat_id', '=', 0)->limit(4)->get();

            //List of Events
            $Events = Event::where('created_by', '=', Auth::user()->id)->where('start_date', '>=',
                date('Y-m-d 00:00:00'))->orderby('start_date', 'asc')->limit(5)->get();


            //List of all contacts
            $Contacts = Contact::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')->limit(5)->get();
        } else {
            //List of all Webmails
            $Webmails = Webmail::orderby('id', 'desc')
                ->where('cat_id', '=', 0)->limit(4)->get();

            //List of Events
            $Events = Event::where('start_date', '>=',
                date('Y-m-d 00:00:00'))->orderby('start_date', 'asc')->limit(5)->get();


            //List of all contacts
            $Contacts = Contact::orderby('id', 'desc')->limit(5)->get();
        }
        // Analytics
        $TodayVisitors = AnalyticsVisitor::where('date', date('Y-m-d'))->count();
        $TodayPages = AnalyticsPage::where('date', date('Y-m-d'))->count();

        // Last 7 Days
        $daterangepicker_start = date('Y-m-d', strtotime('-6 day'));
        $daterangepicker_end = date('Y-m-d');
        $stat = "date";

        $Last7DaysVisitors = array();

        $AnalyticsVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->groupBy($stat)
            ->orderBy($stat, 'asc')
            ->get();
        $ix = 0;
        foreach ($AnalyticsVisitors as $AnalyticsV) {

            $TotalV = AnalyticsVisitor::where("$stat", $AnalyticsV->$stat)
                ->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)->count();

            $AllVArray = AnalyticsVisitor::select('id')->where("$stat", $AnalyticsV->$stat)
                ->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)
                ->get()
                ->toArray();

            $TotalP = AnalyticsPage::whereIn("visitor_id", $AllVArray)->count();

            $newdata = array(
                'name' => $AnalyticsV->$stat,
                'visits' => $TotalV,
                'pages' => $TotalP
            );
            array_push($Last7DaysVisitors, $newdata);
            $ix++;
        }

        // Today By Country
        $date_today = date('Y-m-d');
        $stat = "country";

        $TodayByCountry = array();

        $AnalyticsVisitors = AnalyticsVisitor::where('date', $date_today)
            ->groupBy($stat)
            ->orderBy($stat, 'asc')
            ->get();
        $ix = 0;
        foreach ($AnalyticsVisitors as $AnalyticsV) {

            $TotalV = AnalyticsVisitor::where("$stat", $AnalyticsV->$stat)
                ->where('date', $date_today)->count();

            $AllVArray = AnalyticsVisitor::select('id')->where("$stat", $AnalyticsV->$stat)
                ->where('date', $date_today)
                ->get()
                ->toArray();

            $TotalP = AnalyticsPage::whereIn("visitor_id", $AllVArray)->count();

            $newdata = array(
                'name' => $AnalyticsV->$stat,
                'code' => substr($AnalyticsV->country_code, 0, 2),
                'visits' => $TotalV,
                'pages' => $TotalP
            );
            array_push($TodayByCountry, $newdata);
            $ix++;
        }
        usort($TodayByCountry, function ($a, $b) {
            return $b['visits'] - $a['visits'];
        });

        // Today By Browser
        $date_today = date('Y-m-d');
        $stat = "browser";

        $TodayByBrowsers = array();

        $AnalyticsVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->groupBy($stat)
            ->orderBy($stat, 'asc')
            ->get();
        $ix = 0;
        foreach ($AnalyticsVisitors as $AnalyticsV) {

            $TotalV = AnalyticsVisitor::where("$stat", $AnalyticsV->$stat)
                ->where('date', '>=', $daterangepicker_start)
                ->where('date', '<=', $daterangepicker_end)->count();

            $newdata = array(
                'name' => $AnalyticsV->$stat,
                'visits' => $TotalV
            );
            array_push($TodayByBrowsers, $newdata);
            $ix++;
        }
        usort($TodayByBrowsers, function ($a, $b) {
            return $b['visits'] - $a['visits'];
        });
        $TodayByBrowser1 = "";
        $TodayByBrowser1_val = 0;
        $TodayByBrowser2 = "Other Browsers";
        $TodayByBrowser2_val = 0;
        $ix = 0;
        $emptyB = 0;
        foreach ($TodayByBrowsers as $TodayByBrowser) {
            $emptyBi = 0;
            if ($emptyB == 0) {
                $emptyBi = $ix;
            }
            if ($ix == $emptyBi) {
                $ix2 = 0;
                foreach ($TodayByBrowser as $key => $val) {
                    if ($ix2 == 0) {
                        $TodayByBrowser1 = $val;
                        if ($TodayByBrowser1 != "") {
                            $emptyB = 1;
                        }
                    }
                    if ($ix2 == 1) {
                        $TodayByBrowser1_val = $val;
                    }
                    $ix2++;
                }
            } else {
                $ixx2 = 0;
                foreach ($TodayByBrowser as $key => $val) {
                    if ($ixx2 == 1) {
                        $TodayByBrowser2_val += $val;
                    }
                    $ixx2++;
                }
            }
            $ix++;
        }

        // Visitor Rate today
        $day_date = date('Y-m-d');
        $TodayVisitorsRate = "";
        $fsla = "";
        for ($ii = 0; $ii < 24; $ii = $ii + 2) {
            if ($ii != 0) {
                $fsla = ", ";
            }
            $stepis = $ii + 2;
            $timeis1 = "$ii:00:00<br>";
            $timeis2 = "$stepis:00:00";
            $TotalV = AnalyticsVisitor::where('date', $day_date)
                ->where('time', '>=', $timeis1)
                ->where('time', '<', $timeis2)
                ->count();
            if($TotalV==0){
                $TotalV = 1;
            }
            $TodayVisitorsRate = $TodayVisitorsRate . $fsla . "[$ii,$TotalV]";
        }

        return view('backEnd.home',
            compact("GeneralWebmasterSections", "Webmails", "Events", "Contacts", "TodayVisitors", "TodayPages",
                "Last7DaysVisitors", "TodayByCountry", "TodayByBrowser1", "TodayByBrowser1_val", "TodayByBrowser2",
                "TodayByBrowser2_val", "TodayVisitorsRate"));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        $search_word = "";
        $active_tab = 0;
        return view('backEnd.search', compact("GeneralWebmasterSections", "search_word", "active_tab"));
    }


    /**
     * Search resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $active_tab = 0;
        if ($request->q != "") {
            if (@Auth::user()->permissionsGroup->view_status) {
                //find Contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->where('first_name', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('last_name', 'like', '%' . $request->q . '%')
                    ->orwhere('company', 'like', '%' . $request->q . '%')
                    ->orwhere('city', 'like', '%' . $request->q . '%')
                    ->orwhere('notes', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->get();

                //find Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('title', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('from_name', 'like', '%' . $request->q . '%')
                    ->orwhere('from_email', 'like', '%' . $request->q . '%')
                    ->orwhere('from_phone', 'like', '%' . $request->q . '%')
                    ->orwhere('to_email', 'like', '%' . $request->q . '%')
                    ->orwhere('to_name', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();

                //find Events
                $Events = Event::where('created_by', '=', Auth::user()->id)->where('title', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('details', 'like', '%' . $request->q . '%')
                    ->orderby('start_date', 'desc')->get();

                //find Topics
                $Topics = Topic::where('created_by', '=', Auth::user()->id)->where('title_ar', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('title_en', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_en', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();

                //find Sections
                $Sections = Section::where('created_by', '=', Auth::user()->id)->where('title_ar', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('title_en', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_en', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();
            } else {
                //find Contacts
                $Contacts = Contact::where('first_name', 'like', '%' . $request->q . '%')
                    ->orwhere('last_name', 'like', '%' . $request->q . '%')
                    ->orwhere('company', 'like', '%' . $request->q . '%')
                    ->orwhere('city', 'like', '%' . $request->q . '%')
                    ->orwhere('notes', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->get();

                //find Webmails
                $Webmails = Webmail::where('title', 'like', '%' . $request->q . '%')
                    ->orwhere('from_name', 'like', '%' . $request->q . '%')
                    ->orwhere('from_email', 'like', '%' . $request->q . '%')
                    ->orwhere('from_phone', 'like', '%' . $request->q . '%')
                    ->orwhere('to_email', 'like', '%' . $request->q . '%')
                    ->orwhere('to_name', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();

                //find Events
                $Events = Event::where('title', 'like', '%' . $request->q . '%')
                    ->orwhere('details', 'like', '%' . $request->q . '%')
                    ->orderby('start_date', 'desc')->get();

                //find Topics
                $Topics = Topic::where('title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('title_en', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_en', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();

                //find Sections
                $Sections = Section::where('title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('title_en', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_ar', 'like', '%' . $request->q . '%')
                    ->orwhere('seo_title_en', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->get();

            }
            if (count($Webmails) > 0) {
                $active_tab = 5;
            }
            if (count($Events) > 0) {
                $active_tab = 4;
            }
            if (count($Contacts) > 0) {
                $active_tab = 3;
            }
            if (count($Sections) > 0) {
                $active_tab = 2;
            }
            if (count($Topics) > 0) {
                $active_tab = 1;
            }

        } else {
            return redirect()->action('HomeController@search');
        }
        $search_word = $request->q;

        return view("backEnd.search",
            compact("GeneralWebmasterSections", "search_word", "Webmails", "Contacts", "Events", "Topics", "Sections",
                "active_tab"));
    }

}
