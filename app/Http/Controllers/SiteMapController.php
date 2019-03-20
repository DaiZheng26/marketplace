<?php

namespace App\Http\Controllers;

use App\Section;
use App\Topic;
use App\WebmasterSection;
use Helper;


class SiteMapController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $lang
     * @return \Illuminate\Http\Response
     */
    public function siteMap($lang = "")
    {
        if ($lang == "") {
            $lang = trans('backLang.boxCode');
        }
        if ($lang != "ar" && $lang != "en") {
            $lang = env('DEFAULT_LANGUAGE', 'en');
        }
        \Session::put('locale', $lang);

        $SiteMapDetails = "";
        $slug_var = "seo_url_slug_" . $lang;

        // HOME
        $url_link = url("");
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";

        // Main Site Sections
        $WebmasterSections = WebmasterSection::where("status", 1)->orderby('row_no', 'asc')->get();
        foreach ($WebmasterSections as $WebmasterSection) {

            if ($WebmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = url("$lang/" . $WebmasterSection->$slug_var);
                } else {
                    $url_link = url($WebmasterSection->$slug_var);
                }
            } else {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = url("$lang/" . $WebmasterSection->name);
                } else {
                    $url_link = url($WebmasterSection->name);
                }
            }
            $url_time = date(DATE_ISO8601, strtotime($WebmasterSection->updated_at));

            $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
</url>
            ";
        }


        // Categories
        $Sections = Section::where("status", 1)->orderby('row_no', 'asc')->get();
        foreach ($Sections as $Section) {
            if ($Section->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = url("$lang/" . $Section->$slug_var);
                } else {
                    $url_link = url($Section->$slug_var);
                }
            } else {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = route('FrontendTopicsByCatWithLang', ["lang" => $lang, "section" => $Section->webmasterSection->name, "cat" => $Section->id]);
                } else {
                    $url_link = route('FrontendTopicsByCat', ["section" => $Section->webmasterSection->name, "cat" => $Section->id]);
                }
            }

            $url_time = date(DATE_ISO8601, strtotime($Section->updated_at));

            $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>
            ";
        }

        // Topics

        // about
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "about");
        } else {
            $url_link = url("about");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // contact
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "contact");
        } else {
            $url_link = url("contact");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // privacy
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "privacy");
        } else {
            $url_link = url("privacy");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // terms
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "terms");
        } else {
            $url_link = url("terms");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";

        // All Other Topics

        $Topics = Topic::where([['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();
        foreach ($Topics as $Topic) {
            if ($Topic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = url("$lang/" . $Topic->$slug_var);
                } else {
                    $url_link = url($Topic->$slug_var);
                }
            } else {
                if ($lang != env('DEFAULT_LANGUAGE')) {
                    $url_link = route('FrontendTopicByLang', ["lang" => $lang, "section" => $Topic->webmasterSection->name, "id" => $Topic->id]);
                } else {
                    $url_link = route('FrontendTopic', ["section" => $Topic->webmasterSection->name, "id" => $Topic->id]);
                }
            }

            $url_time = date(DATE_ISO8601, strtotime($Topic->updated_at));

            $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>
            ";
        }


        return response()->view("frontEnd.sitemap", compact("SiteMapDetails"))->header('Content-Type', 'text/xml');
    }
}
