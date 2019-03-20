<?php

namespace App\Http\Controllers;

use App\AnalyticsPage;
use App\AnalyticsVisitor;
use App\Http\Requests;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->analytics_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     * string $stat
     * @return \Illuminate\Http\Response
     */

    public function index($stat = "date")
    {
        // check @stat var
        $analyticsVars = array("date", "country", "city", "os", "browser", "referrer", "hostname", "org");
        if (!in_array($stat, $analyticsVars)) {
            return redirect()->action('AnalyticsController@index');
        }
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List Min & Max
        $AnalyticsMin = AnalyticsVisitor::min("date");
        $AnalyticsMax = AnalyticsVisitor::max("date");


        $daterangepicker_start = date('Y-m-d', strtotime('-29 day'));
        $daterangepicker_end = date('Y-m-d');
        $daterangepicker_start_text = date("F d , Y", strtotime($daterangepicker_start));
        $daterangepicker_end_text = date("F d , Y", strtotime($daterangepicker_end));
        $min_visitor_date = date('d-m-Y', strtotime('-29 day'));
        if ($AnalyticsMin != "") {
            $min_visitor_date = date('d-m-Y', strtotime($AnalyticsMin));
        }
        $max_visitor_date = date('d-m-Y');
        if ($AnalyticsMax != "") {
            $max_visitor_date = date('d-m-Y', strtotime($AnalyticsMax));
        }


        $AnalyticsValues = array();

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
            array_push($AnalyticsValues, $newdata);
            $ix++;
        }
        if ($stat == "date") {

        } else {
            usort($AnalyticsValues, function ($a, $b) {
                return $b['visits'] - $a['visits'];
            });
        }

        $TotalVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->count();

        $TotalPages = AnalyticsPage::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->count();

        if ($stat == "org") {
            $statText = "visitorsAnalyticsByOrganization";
        } elseif ($stat == "hostname") {
            $statText = "visitorsAnalyticsByHostName";
        } elseif ($stat == "referrer") {
            $statText = "visitorsAnalyticsByReachWay";
        } elseif ($stat == "resolution") {
            $statText = "visitorsAnalyticsByScreenResolution";
        } elseif ($stat == "browser") {
            $statText = "visitorsAnalyticsByBrowser";
        } elseif ($stat == "os") {
            $statText = "visitorsAnalyticsByOperatingSystem";
        } elseif ($stat == "country") {
            $statText = "visitorsAnalyticsByCountry";
        } elseif ($stat == "city") {
            $statText = "visitorsAnalyticsByCity";
        } else {
            $statText = "visitorsAnalyticsBydate";
        }


        return view("backEnd.analytics",
            compact("GeneralWebmasterSections", "daterangepicker_start", "daterangepicker_end",
                "daterangepicker_start_text", "daterangepicker_end_text", "min_visitor_date", "max_visitor_date",
                "stat", "AnalyticsVisitors", "TotalVisitors", "TotalPages", "statText", "AnalyticsValues"));

    }

    /**
     * Display a listing of the resource.
     * string $stat
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request, $stat = "date")
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List Min & Max
        $AnalyticsMin = AnalyticsVisitor::min("date");
        $AnalyticsMax = AnalyticsVisitor::max("date");


        $daterangepicker_start = date('Y-m-d', strtotime('-29 day'));
        if ($request->this_daterangepicker_start != "") {
            $daterangepicker_start = $request->this_daterangepicker_start;
        }
        $daterangepicker_end = date('Y-m-d');
        if ($request->this_daterangepicker_end != "") {
            $daterangepicker_end = $request->this_daterangepicker_end;
        }
        $daterangepicker_start_text = date("F d , Y", strtotime($daterangepicker_start));
        $daterangepicker_end_text = date("F d , Y", strtotime($daterangepicker_end));
        $min_visitor_date = date('d-m-Y', strtotime('-29 day'));
        if ($AnalyticsMin != "") {
            $min_visitor_date = date('d-m-Y', strtotime($AnalyticsMin));
        }
        $max_visitor_date = date('d-m-Y');
        if ($AnalyticsMax != "") {
            $max_visitor_date = date('d-m-Y', strtotime($AnalyticsMax));
        }


        $AnalyticsValues = array();

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
            array_push($AnalyticsValues, $newdata);
            $ix++;
        }

        if ($stat == "date") {

        } else {
            usort($AnalyticsValues, function ($a, $b) {
                return $b['visits'] - $a['visits'];
            });
        }

        $TotalVisitors = AnalyticsVisitor::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->count();

        $TotalPages = AnalyticsPage::where('date', '>=', $daterangepicker_start)
            ->where('date', '<=', $daterangepicker_end)
            ->count();

        if ($stat == "org") {
            $statText = "visitorsAnalyticsByOrganization";
        } elseif ($stat == "hostname") {
            $statText = "visitorsAnalyticsByHostName";
        } elseif ($stat == "referrer") {
            $statText = "visitorsAnalyticsByReachWay";
        } elseif ($stat == "resolution") {
            $statText = "visitorsAnalyticsByScreenResolution";
        } elseif ($stat == "browser") {
            $statText = "visitorsAnalyticsByBrowser";
        } elseif ($stat == "os") {
            $statText = "visitorsAnalyticsByOperatingSystem";
        } elseif ($stat == "country") {
            $statText = "visitorsAnalyticsByCountry";
        } elseif ($stat == "city") {
            $statText = "visitorsAnalyticsByCity";
        } else {
            $statText = "visitorsAnalyticsBydate";
        }

        return view("backEnd.analytics",
            compact("GeneralWebmasterSections", "daterangepicker_start", "daterangepicker_end",
                "daterangepicker_start_text", "daterangepicker_end_text", "min_visitor_date", "max_visitor_date",
                "stat", "AnalyticsVisitors", "TotalVisitors", "TotalPages", "statText", "AnalyticsValues"));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visitors()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Analytics Visitors
        $AnalyticsVisitors = AnalyticsVisitor::orderby('date', 'desc')->orderby('time',
            'desc')->paginate(env('BACKEND_PAGINATION'));

        return view("backEnd.visitors", compact("GeneralWebmasterSections", "AnalyticsVisitors"));
    }

    /**
     * Display a listing of the resource.
     * string $ip_code
     * @return \Illuminate\Http\Response
     */

    public function ip($ip_code = null)
    {
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Analytics Visitors
        if ($ip_code != "") {
            $AnalyticsVisitors = AnalyticsVisitor::where('ip', $ip_code)
                ->orderby('id', 'desc')->get();
        } else {
            $AnalyticsVisitors = "";
        }

        return view("backEnd.ip", compact("GeneralWebmasterSections", "AnalyticsVisitors", "ip_code"));
    }

    /**
     * Search resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function search(
        Request $request
    ) {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if ($request->ip != "") {
            $AnalyticsVisitors = AnalyticsVisitor::where('ip', $request->ip)
                ->orderby('id', 'desc')->get();
        } else {
            $AnalyticsVisitors = "";
        }

        $ip_code = $request->ip;

        return view("backEnd.ip", compact("GeneralWebmasterSections", "AnalyticsVisitors", "ip_code"));
    }


}
