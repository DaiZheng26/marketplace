<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Setting;
use App\Webmail;
use App\WebmailsFile;
use App\WebmailsGroup;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Config;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Validator;


class WebmailsController extends Controller
{

    private $uploadPath = "uploads/inbox/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->inbox_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     * int $group_id
     * int $wid
     * int $contact_email
     * string $stat
     * @return \Illuminate\Http\Response
     */
    public function index($group_id = null, $wid = null, $stat = null, $contact_email = null)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of groups
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmailsGroups = WebmailsGroup::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();

            if ($group_id > 0) {
                //List of group Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('group_id', '=', $group_id)
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "create") {
                //if replay or forward

                if ($wid > 0) {
                    $WebmailToreply = Webmail::where('created_by', '=', Auth::user()->id)->find($wid);
                    if (count($WebmailToreply) > 0) {
                        $WebmailToreply = $WebmailToreply;
                    } else {
                        $WebmailToreply = "";
                    }
                } else {
                    $WebmailToreply = "";
                }


            } elseif ($group_id == "sent") {
                //List of Sent
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('cat_id', '=', 1)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "draft") {
                //List of draft
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('cat_id', '=', 2)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "wait") {
                //List Unread Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('status', '=', '0')
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "blocked") {
                //List readed Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('status', '=', '1')
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')
                    ->where('cat_id', '=', 0)
                    ->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            $WebmailsGroups = WebmailsGroup::orderby('id', 'asc')->get();

            if ($group_id > 0) {
                //List of group Webmails
                $Webmails = Webmail::where('group_id', '=', $group_id)
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "create") {
                //if replay or forward

                if ($wid > 0) {
                    $WebmailToreply = Webmail::find($wid);
                    if (count($WebmailToreply) > 0) {
                        $WebmailToreply = $WebmailToreply;
                    } else {
                        $WebmailToreply = "";
                    }
                } else {
                    $WebmailToreply = "";
                }


            } elseif ($group_id == "sent") {
                //List of Sent
                $Webmails = Webmail::where('cat_id', '=', 1)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "draft") {
                //List of draft
                $Webmails = Webmail::where('cat_id', '=', 2)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "wait") {
                //List Unread Webmails
                $Webmails = Webmail::where('status', '=', '0')
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "blocked") {
                //List readed Webmails
                $Webmails = Webmail::where('status', '=', '1')
                    ->where('cat_id', '=', 0)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all Webmails
                $Webmails = Webmail::orderby('id', 'desc')
                    ->where('cat_id', '=', 0)
                    ->paginate(env('BACKEND_PAGINATION'));
            }
        }


        if (@Auth::user()->permissionsGroup->view_status) {
            //Count of unread
            $WaitWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '0')->count();

            //Count of draft
            $DraftWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->where('cat_id', '=',
                '2')->count();

            //Count of All Webmails
            $AllWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->count();
        } else {
            //Count of unread
            $WaitWebmailsCount = Webmail::where('status', '=', '0')->count();

            //Count of draft
            $DraftWebmailsCount = Webmail::where('cat_id', '=', '2')->count();

            //Count of All Webmails
            $AllWebmailsCount = Webmail::count();
        }
        // Site Settings
        $SiteSetting = Setting::find(1);


        $search_word = "";

        return view("backEnd.webmails",
            compact("Webmails", "GeneralWebmasterSections", "WebmailsGroups", "WaitWebmailsCount", "DraftWebmailsCount",
                "AllWebmailsCount", "group_id", "WebmailToreply", "stat", "search_word", "SiteSetting",
                "contact_email"));
    }

    /**
     * Search resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of groups
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmailsGroups = WebmailsGroup::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();

            if ($request->q != "") {
                //find Webmails
                $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->where('title', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('details', 'like', '%' . $request->q . '%')
                    ->orwhere('from_name', 'like', '%' . $request->q . '%')
                    ->orwhere('from_email', 'like', '%' . $request->q . '%')
                    ->orwhere('from_phone', 'like', '%' . $request->q . '%')
                    ->orwhere('to_email', 'like', '%' . $request->q . '%')
                    ->orwhere('to_name', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                return redirect()->action('WebmailsController@index');
            }
            //Count of unread
            $WaitWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '0')->count();

            //Count of draft
            $DraftWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '2')->count();

            //Count of All Webmails
            $AllWebmailsCount = Webmail::where('created_by', '=', Auth::user()->id)->count();
        } else {
            $WebmailsGroups = WebmailsGroup::orderby('id', 'asc')->get();

            if ($request->q != "") {
                //find Webmails
                $Webmails = Webmail::where('title', 'like', '%' . $request->q . '%')
                    ->orwhere('details', 'like', '%' . $request->q . '%')
                    ->orwhere('from_name', 'like', '%' . $request->q . '%')
                    ->orwhere('from_email', 'like', '%' . $request->q . '%')
                    ->orwhere('from_phone', 'like', '%' . $request->q . '%')
                    ->orwhere('to_email', 'like', '%' . $request->q . '%')
                    ->orwhere('to_name', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                return redirect()->action('WebmailsController@index');
            }
            //Count of unread
            $WaitWebmailsCount = Webmail::where('status', '=', '0')->count();

            //Count of draft
            $DraftWebmailsCount = Webmail::where('status', '=', '2')->count();

            //Count of All Webmails
            $AllWebmailsCount = Webmail::count();
        }
        $group_id = "";
        $search_word = $request->q;

        return view("backEnd.webmails",
            compact("Webmails", "GeneralWebmasterSections", "WebmailsGroups", "WaitWebmailsCount", "DraftWebmailsCount",
                "AllWebmailsCount", "group_id", "search_word"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeGroup(Request $request)
    {
        //
        $str_color_ary = array(
            "# 00bcd4",
            "#f44336",
            "#8bc34a",
            "#9c27b0",
            "#2196f3",
            "#4caf50",
            "#cddc39",
            "#e91e63",
            "#673ab7",
            "#009688",
            "#3f51b5"
        );
        $WebmailsGroupCount = WebmailsGroup::orderby('id', 'desc')->count();
        $WebmailsGroup = WebmailsGroup::orderby('id', 'desc')->first();
        if ($WebmailsGroupCount > 0) {
            $ary_key = array_search($WebmailsGroup->color, $str_color_ary);
            $ary_key++;
            if ($ary_key > 10) {
                $ary_key = 0;
            }
            $str_color = $str_color_ary[$ary_key];
        } else {
            $str_color = $str_color_ary[0];
        }


        $WebmailsGroup = new WebmailsGroup;
        $WebmailsGroup->name = $request->name;
        $WebmailsGroup->color = $str_color;
        $WebmailsGroup->created_by = Auth::user()->id;
        $WebmailsGroup->save();

        return redirect()->action('WebmailsController@index');
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
        $Webmail = new Webmail;
        if ($request->btn_clicked == "draft") {
            $Webmail->cat_id = 2;
        } else {
            $Webmail->cat_id = 1;
        }
        $Webmail->group_id = null;
        $Webmail->contact_id = $request->contact_id;
        $Webmail->father_id = $request->father_id;
        $Webmail->title = $request->title;
        $Webmail->details = $request->details;
        $Webmail->date = date("Y-m-d H:i:s");
        $Webmail->from_email = $request->from_email;
        $Webmail->from_name = $request->from_name;
        $Webmail->from_phone = $request->from_phone;
        $Webmail->to_email = $request->to_email;
        $Webmail->to_name = $request->to_name;
        $Webmail->to_cc = $request->to_cc;
        $Webmail->to_bcc = $request->to_bcc;
        $Webmail->status = 1;
        $Webmail->flag = 0;
        $Webmail->created_by = Auth::user()->id;
        $Webmail->save();

        if ($request->btn_clicked != "draft") {
            // getting all of the post data
            $files = $request->file('attach_files');
            // Making counting of uploaded images
            $file_count = count($files);
            if ($file_count > 0) {
                // start count how many uploaded
                $uploadcount = 0;
                if ($file_count > 0) {
                    foreach ($files as $file) {
                        $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                        $validator = Validator::make(array('file' => $file), $rules);
                        if ($validator->passes()) {
                            $path = $this->getUploadPath();
                            $filename = $file->getClientOriginalName();
                            $upload_success = $file->move($path, $filename);
                            $uploadcount++;
                            // save in DB
                            $WebmailsFile = new WebmailsFile;
                            $WebmailsFile->webmail_id = $Webmail->id;
                            $WebmailsFile->file = $filename;
                            $WebmailsFile->save();
                        }
                    }
                }
            }

        }

        if ($request->btn_clicked != "draft") {
            // SEND THIS EMAIL
            if (env('MAIL_USERNAME') != "") {

                $WebsiteSettings = Setting::find(1);
                $site_title_var = "site_title_" . trans('backLang.boxCode');

                Mail::send('backEnd.emails.webmail', [
                    'title' => $request->title,
                    'details' => $request->details,
                    'websiteURL' => $WebsiteSettings->site_url,
                    'websiteName' => $WebsiteSettings->$site_title_var
                ], function ($message) use ($request) {
                    $message->from($request->from_email, $request->from_name);
                    $message->to($request->to_email);
                    if ($request->to_cc != "") {
                        $message->cc($request->to_cc);
                    }
                    if ($request->to_bcc != "") {
                        $message->bcc($request->to_cc);
                    }
                    $message->replyTo($request->from_email, $request->from_name);
                    $message->subject($request->title);


                });
            }
        }

        return redirect()->action('WebmailsController@index');
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
        //
        $WebmailToEdit = Webmail::find($id);
        if (count($WebmailToEdit) > 0) {
            $WebmailToEdit->status = 1;
            $WebmailToEdit->save();
            return redirect()->action('WebmailsController@index', $WebmailToEdit->group_id)->with('WebmailToEdit',
                $WebmailToEdit);
        } else {
            return redirect()->action('WebmailsController@index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editGroup($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $EditWebmailsGroup = WebmailsGroup::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $EditWebmailsGroup = WebmailsGroup::find($id);
        }
        if (count($EditWebmailsGroup) > 0) {
            return redirect()->action('WebmailsController@index')->with('EditWebmailsGroup', $EditWebmailsGroup);
        } else {
            return redirect()->action('WebmailsController@index');
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
        $Webmail = Webmail::find($id);
        if (count($Webmail) > 0) {

            if ($request->btn_clicked == "draft") {
                $Webmail->cat_id = 2;
            } else {
                $Webmail->cat_id = 1;
            }
            $Webmail->contact_id = $request->contact_id;
            $Webmail->father_id = $request->father_id;
            $Webmail->title = $request->title;
            $Webmail->details = $request->details;
            $Webmail->date = date("Y-m-d H:i:s");
            $Webmail->from_email = $request->from_email;
            $Webmail->from_name = $request->from_name;
            $Webmail->from_phone = $request->from_phone;
            $Webmail->to_email = $request->to_email;
            $Webmail->to_name = $request->to_name;
            $Webmail->to_cc = $request->to_cc;
            $Webmail->to_bcc = $request->to_bcc;
            $Webmail->updated_by = Auth::user()->id;
            $Webmail->save();

            if ($request->btn_clicked != "draft") {
                // getting all of the post data
                $files = $request->file('attach_files');
                // Making counting of uploaded images
                $file_count = count($files);
                if ($file_count > 0) {
                    // start count how many uploaded
                    $uploadcount = 0;
                    foreach ($files as $file) {
                        $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                        $validator = Validator::make(array('file' => $file), $rules);
                        if ($validator->passes()) {
                            $path = $this->getUploadPath();
                            $filename = $file->getClientOriginalName();
                            $upload_success = $file->move($path, $filename);
                            $uploadcount++;
                            // save in DB
                            $WebmailsFile = new WebmailsFile;
                            $WebmailsFile->webmail_id = $Webmail->id;
                            $WebmailsFile->file = $filename;
                            $WebmailsFile->save();
                        }
                    }
                }

            }


            if ($request->btn_clicked != "draft") {
                // SEND THIS EMAIL
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => $request->title,
                        'details' => $request->details,
                        'websiteURL' => 'url',
                        'websiteName' => 'site name'
                    ], function ($message) use ($request) {
                        $message->from($request->from_email, $request->from_name);
                        $message->to($request->to_email);
                        if ($request->to_cc != "") {
                            $message->cc($request->to_cc);
                        }
                        if ($request->to_bcc != "") {
                            $message->bcc($request->to_cc);
                        }
                        $message->replyTo($request->from_email, $request->from_name);
                        $message->subject($request->title);


                    });
                }
            }

            return redirect()->action('WebmailsController@index');
        } else {
            return redirect()->action('WebmailsController@index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateGroup(Request $request, $id)
    {
        //
        $WebmailsGroup = WebmailsGroup::find($id);
        if (count($WebmailsGroup) > 0) {
            $WebmailsGroup->name = $request->name;
            $WebmailsGroup->updated_by = Auth::user()->id;
            $WebmailsGroup->save();
        }
        return redirect()->action('WebmailsController@index');
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
            $Webmail = Webmail::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Webmail = Webmail::find($id);
        }
        if (count($Webmail) > 0) {

            $Webmail->delete();
        }
        return redirect()->action('WebmailsController@index');

    }

    public function destroyGroup($id)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->delete_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmailsGroup = WebmailsGroup::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmailsGroup = WebmailsGroup::find($id);
        }
        if (count($WebmailsGroup) > 0) {
            $WebmailsGroup->delete();
            return redirect()->action('WebmailsController@index');
        } else {
            return redirect()->action('WebmailsController@index');
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
        if ($request->action == "read") {
            Webmail::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "unread") {
            Webmail::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->delete_status) {
                return Redirect::to(route('NoPermission'))->send();
            }
            // Delete files
            $WebmailsFiles = WebmailsFile::wherein('webmail_id', $request->ids)->get();
            foreach ($WebmailsFiles as $WebmailsFile) {
                if ($WebmailsFile->file != "") {
                    File::delete($this->getUploadPath() . $WebmailsFile->file);
                }
            }

            WebmailsFile::wherein('webmail_id', $request->ids)
                ->delete();

            Webmail::wherein('id', $request->ids)
                ->delete();

        } elseif ($request->action == "move") {

            Webmail::wherein('id', $request->ids)
                ->update(['group_id' => $request->group]);

        }
        return redirect()->action('WebmailsController@index')->with('doneMessage2', trans('backLang.saveDone'));
    }


}