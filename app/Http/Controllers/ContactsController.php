<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactsGroup;
use App\Country;
use App\Http\Requests;
use App\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;

class ContactsController extends Controller
{

    private $uploadPath = "uploads/contacts/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->newsletter_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     * int $group_id
     * @return \Illuminate\Http\Response
     */
    public function index($group_id = null)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of groups
        if (@Auth::user()->permissionsGroup->view_status) {
            $ContactsGroups = ContactsGroup::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();
        } else {
            $ContactsGroups = ContactsGroup::orderby('id', 'asc')->get();
        }

        //List of Countries
        $Countries = Country::orderby('title_' . trans('backLang.boxCode'), 'asc')->get();

        if (@Auth::user()->permissionsGroup->view_status) {
            if ($group_id > 0) {
                //List of group contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->where('group_id', '=',
                    $group_id)->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "wait") {
                //List waiting activation Contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                    '0')->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "blocked") {
                //List waiting activation Contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                    '2')->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($group_id > 0) {
                //List of group contacts
                $Contacts = Contact::where('group_id', '=', $group_id)->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "wait") {
                //List waiting activation Contacts
                $Contacts = Contact::where('status', '=', '0')->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } elseif ($group_id == "blocked") {
                //List waiting activation Contacts
                $Contacts = Contact::where('status', '=', '2')->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all contacts
                $Contacts = Contact::orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }

        if (@Auth::user()->permissionsGroup->view_status) {
            //Count of waiting activation Contacts
            $WaitContactsCount = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '0')->count();

            //Count of Blocked Contacts
            $BlockedContactsCount = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '2')->count();

            //Count of All Contacts
            $AllContactsCount = Contact::where('created_by', '=', Auth::user()->id)->count();
        } else {
            //Count of waiting activation Contacts
            $WaitContactsCount = Contact::where('status', '=', '0')->count();

            //Count of Blocked Contacts
            $BlockedContactsCount = Contact::where('status', '=', '2')->count();

            //Count of All Contacts
            $AllContactsCount = Contact::count();
        }


        $search_word = "";

        return view("backEnd.contacts",
            compact("Contacts", "GeneralWebmasterSections", "ContactsGroups", "Countries", "WaitContactsCount",
                "BlockedContactsCount", "AllContactsCount", "group_id", "search_word"));
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
            $ContactsGroups = ContactsGroup::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();
        } else {
            $ContactsGroups = ContactsGroup::orderby('id', 'asc')->get();
        }

        //List of Countries
        $Countries = Country::orderby('title_' . trans('backLang.boxCode'), 'asc')->get();

        if (@Auth::user()->permissionsGroup->view_status) {
            if ($request->q != "") {
                //find Contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->where('first_name', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('last_name', 'like', '%' . $request->q . '%')
                    ->orwhere('company', 'like', '%' . $request->q . '%')
                    ->orwhere('city', 'like', '%' . $request->q . '%')
                    ->orwhere('notes', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all contacts
                $Contacts = Contact::where('created_by', '=', Auth::user()->id)->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($request->q != "") {
                //find Contacts
                $Contacts = Contact::where('first_name', 'like', '%' . $request->q . '%')
                    ->orwhere('last_name', 'like', '%' . $request->q . '%')
                    ->orwhere('company', 'like', '%' . $request->q . '%')
                    ->orwhere('city', 'like', '%' . $request->q . '%')
                    ->orwhere('notes', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all contacts
                $Contacts = Contact::orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }
        if (@Auth::user()->permissionsGroup->view_status) {
            //Count of waiting activation Contacts
            $WaitContactsCount = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '0')->count();

            //Count of Blocked Contacts
            $BlockedContactsCount = Contact::where('created_by', '=', Auth::user()->id)->where('status', '=',
                '2')->count();

            //Count of All Contacts
            $AllContactsCount = Contact::where('created_by', '=', Auth::user()->id)->count();
        } else {
            //Count of waiting activation Contacts
            $WaitContactsCount = Contact::where('status', '=', '0')->count();

            //Count of Blocked Contacts
            $BlockedContactsCount = Contact::where('status', '=', '2')->count();

            //Count of All Contacts
            $AllContactsCount = Contact::count();
        }
        $group_id = "";
        $search_word = $request->q;

        return view("backEnd.contacts",
            compact("Contacts", "GeneralWebmasterSections", "ContactsGroups", "Countries", "WaitContactsCount",
                "BlockedContactsCount", "AllContactsCount", "group_id", "search_word"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeGroup(Request $request)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->add_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        $ContactsGroup = new ContactsGroup;
        $ContactsGroup->name = $request->name;
        $ContactsGroup->created_by = Auth::user()->id;
        $ContactsGroup->save();

        return redirect()->action('ContactsController@index');
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
            'file' => 'mimes:png,jpeg,jpg,gif|max:3000'
        ]);


        // Start of Upload Files
        $formFileName = "file";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        // End of Upload Files

        $Contact = new Contact;
        $Contact->group_id = $request->group_id;
        $Contact->first_name = $request->first_name;
        $Contact->last_name = $request->last_name;
        $Contact->company = $request->company;
        $Contact->email = $request->email;
        $Contact->password = $request->password;
        $Contact->phone = $request->phone;
        $Contact->country_id = $request->country_id;
        $Contact->city = $request->city;
        $Contact->address = $request->address;
        $Contact->address = $request->address;
        $Contact->photo = $fileFinalName_ar;
        $Contact->notes = $request->notes;
        $Contact->status = 1;
        $Contact->created_by = Auth::user()->id;
        $Contact->save();

        return redirect()->action('ContactsController@index');
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
        $ContactToEdit = Contact::find($id);
        if (count($ContactToEdit) > 0) {
            return redirect()->action('ContactsController@index', $ContactToEdit->group_id)->with('ContactToEdit',
                $ContactToEdit);
        } else {
            return redirect()->action('ContactsController@index');
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
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->edit_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $EditContactsGroup = ContactsGroup::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $EditContactsGroup = ContactsGroup::find($id);
        }
        if (count($EditContactsGroup) > 0) {
            return redirect()->action('ContactsController@index')->with('EditContactsGroup', $EditContactsGroup);
        } else {
            return redirect()->action('ContactsController@index');
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
        if (!@Auth::user()->permissionsGroup->edit_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Contact = Contact::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Contact = Contact::find($id);
        }
        if (count($Contact) > 0) {


            $this->validate($request, [
                'file' => 'mimes:png,jpeg,jpg,gif|max:3000'
            ]);


            // Start of Upload Files
            $formFileName = "file";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            // End of Upload Files

            $Contact->group_id = $request->group_id;
            $Contact->first_name = $request->first_name;
            $Contact->last_name = $request->last_name;
            $Contact->company = $request->company;
            $Contact->email = $request->email;
            $Contact->password = $request->password;
            $Contact->phone = $request->phone;
            $Contact->country_id = $request->country_id;
            $Contact->city = $request->city;
            $Contact->address = $request->address;
            $Contact->address = $request->address;
            $Contact->notes = $request->notes;

            if ($fileFinalName_ar != "") {
                // Delete a Contact file
                if ($Contact->photo != "") {
                    File::delete($this->getUploadPath() . $Contact->photo);
                }

                $Contact->photo = $fileFinalName_ar;
            }

            $Contact->status = $request->status;
            $Contact->updated_by = Auth::user()->id;
            $Contact->save();
            return redirect()->action('ContactsController@index')->with('ContactToEdit', $Contact)->with('doneMessage2',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('ContactsController@index');
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
        $ContactsGroup = ContactsGroup::find($id);
        if (count($ContactsGroup) > 0) {
            $ContactsGroup->name = $request->name;
            $ContactsGroup->updated_by = Auth::user()->id;
            $ContactsGroup->save();
        }
        return redirect()->action('ContactsController@index');
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
            $Contact = Contact::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Contact = Contact::find($id);
        }
        if (count($Contact) > 0) {
            // Delete a Contact file
            if ($Contact->photo != "") {
                File::delete($this->getUploadPath() . $Contact->photo);
            }

            $Contact->delete();
        }
        return redirect()->action('ContactsController@index');

    }

    public function destroyGroup($id)
    {
        // Check Permissions
        if (!@Auth::user()->permissionsGroup->delete_status) {
            return Redirect::to(route('NoPermission'))->send();
        }
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $ContactsGroup = ContactsGroup::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $ContactsGroup = ContactsGroup::find($id);
        }
        if (count($ContactsGroup) > 0) {
            $ContactsGroup->delete();
            return redirect()->action('ContactsController@index');
        } else {
            return redirect()->action('ContactsController@index');
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
        if ($request->action == "activate") {
            Contact::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            Contact::wherein('id', $request->ids)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            // Check Permissions
            if (!@Auth::user()->permissionsGroup->delete_status) {
                return Redirect::to(route('NoPermission'))->send();
            }
            // Delete Contacts file
            $Contacts = Contact::wherein('id', $request->ids)->get();
            foreach ($Contacts as $Contact) {
                if ($Contact->photo != "") {
                    File::delete($this->getUploadPath() . $Contact->photo);
                }
            }

            Contact::wherein('id', $request->ids)
                ->delete();

        }
        return redirect()->action('ContactsController@index')->with('doneMessage', trans('backLang.saveDone'));
    }


}