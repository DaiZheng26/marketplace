<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Permissions;
use App\User;
use App\Category;
use App\Subcategory;
use App\Ssubcategory;
use App\Sssubcategory;
use App\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;

class CategoriesController extends Controller
{

    private $uploadPath = "public/uploads/categories/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
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
            $Categories = Category::orderby('name',
                'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();
        } else {
            $Categories = Category::orderby('name', 'asc')->paginate(env('BACKEND_PAGINATION'));
            // $categories = Category::nested()->get();

            $Permissions = Permissions::orderby('id', 'asc')->get();
        }
      
        return view("backEnd.category", compact("Categories", "Permissions", "GeneralWebmasterSections"));
    }

    public function create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        $Permissions = Permissions::orderby('id', 'asc')->get();

        return view("backEnd.categories.create", compact("GeneralWebmasterSections", "Permissions"));
    }

    public function subcategory($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
         
        $Categories = Subcategory::where('category_id', '=', $category_id)->orderby('name','asc')->paginate(env('BACKEND_PAGINATION'));
       
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.subcategory", compact("Categories", "Permissions","category_id", "GeneralWebmasterSections"));

    }
    public function subcreate($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.subcategories.create", compact("GeneralWebmasterSections","category_id", "Permissions"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function substore(Request $request)
    {
       
        $this->validate($request, [
             'category' => 'required',    
        ]);


        // Start of Upload Files
        

        $Subcategory = new Subcategory;
        $Subcategory->name = $request->category;
        $Subcategory->category_id = $request->category_id;
        $Subcategory->save();

        return redirect()->route("subCategories",["category_id"=>$request->category_id]);
    }

    public function subedit($id,$category_id)
    {
     
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();

        $Categories = Subcategory::find($id);
 
        if (count($Categories) > 0) {
            return view("backEnd.subcategories.edit", compact("Categories","category_id", "GeneralWebmasterSections"));
        } else {
            return redirect()->route("subCategories",["category_id"=>$category_id]);

        }
    }

    public function subupdate(Request $request, $id)
    {
        //
        $Subcategory = Subcategory::find($id);
        if (count($Subcategory) > 0) {


            $this->validate($request, [
                 'category' => 'required',
             ]);

            // Start of Upload Files
           
            // End of Upload Files

            //if ($id != 1) {
                $Subcategory->name = $request->category;
                  
             //}
             
            
            
            $Subcategory->save();
            return redirect()->action('CategoriesController@subcategory', $request->category_id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategoriesController@index');
        }
    }

    public function subdestroy($id, $category_id)
    {
        //
       
        $Subategory = Subcategory::find($id);
        
        if (count($Subategory) > 0 && $id != 1) {
           

            $Subategory->delete();
            return redirect()->action('CategoriesController@subcategory', $category_id)->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategoriesController@index');
        }
    }

    //ssub category 

    public function ssubcategory($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
         
        $Categories = Ssubcategory::where('category_id', '=', $category_id)->orderby('name','asc')->paginate(env('BACKEND_PAGINATION'));
       
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.ssubcategory", compact("Categories", "Permissions","category_id", "GeneralWebmasterSections"));

    }
    public function ssubcreate($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.ssubcategories.create", compact("GeneralWebmasterSections","category_id", "Permissions"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function ssubstore(Request $request)
    {
       
        $this->validate($request, [
             'category' => 'required',    
        ]);


        // Start of Upload Files
        

        $Subcategory = new Ssubcategory;
        $Subcategory->name = $request->category;
        $Subcategory->category_id = $request->category_id;
        $Subcategory->save();

        return redirect()->route("ssubCategories",["category_id"=>$request->category_id]);
    }

    public function ssubedit($id,$category_id)
    {
     
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();

        $Categories = Ssubcategory::find($id);
 
        if (count($Categories) > 0) {
            return view("backEnd.ssubcategories.edit", compact("Categories","category_id", "GeneralWebmasterSections"));
        } else {
            return redirect()->route("subCategories",["category_id"=>$category_id]);

        }
    }

    public function ssubupdate(Request $request, $id)
    {
        //
        $Subcategory = Ssubcategory::find($id);
        if (count($Subcategory) > 0) {


            $this->validate($request, [
                 'category' => 'required',
             ]);

            // Start of Upload Files
           
            // End of Upload Files

            //if ($id != 1) {
                $Subcategory->name = $request->category;
                  
             //}
             
            
            
            $Subcategory->save();
            return redirect()->action('CategoriesController@ssubcategory', $request->category_id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategoriesController@index');
        }
    }

    public function ssubdestroy($id, $category_id)
    {
        //
       
        $Subategory = Ssubcategory::find($id);
        
        if (count($Subategory) > 0 && $id != 1) {
           

            $Subategory->delete();
            return redirect()->action('CategoriesController@ssubcategory', $category_id)->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategoriesController@index');
        }
    }


    //sssub category

    public function sssubcategory($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
         
        $Categories = Sssubcategory::where('category_id', '=', $category_id)->orderby('name','asc')->paginate(env('BACKEND_PAGINATION'));
       
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.sssubcategory", compact("Categories", "Permissions","category_id", "GeneralWebmasterSections"));

    }
    public function sssubcreate($category_id){
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        $Permissions = Permissions::orderby('id', 'asc')->get();
        return view("backEnd.sssubcategories.create", compact("GeneralWebmasterSections","category_id", "Permissions"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    public function sssubstore(Request $request)
    {
       
        $this->validate($request, [
             'category' => 'required',    
        ]);


        // Start of Upload Files
        

        $Subcategory = new Sssubcategory;
        $Subcategory->name = $request->category;
        $Subcategory->category_id = $request->category_id;
        $Subcategory->save();

        return redirect()->route("sssubCategories",["category_id"=>$request->category_id]);
    }

    public function sssubedit($id,$category_id)
    {
     
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();

        $Categories = Sssubcategory::find($id);
 
        if (count($Categories) > 0) {
            return view("backEnd.sssubcategories.edit", compact("Categories","category_id", "GeneralWebmasterSections"));
        } else {
            return redirect()->route("subCategories",["category_id"=>$category_id]);

        }
    }

    public function sssubupdate(Request $request, $id)
    {
        //
        $Subcategory = Sssubcategory::find($id);
        if (count($Subcategory) > 0) {


            $this->validate($request, [
                 'category' => 'required',
             ]);

            // Start of Upload Files
           
            // End of Upload Files

            //if ($id != 1) {
                $Subcategory->name = $request->category;
                  
             //}
             
            
            
            $Subcategory->save();
            return redirect()->action('CategoriesController@sssubcategory', $request->category_id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategoriesController@index');
        }
    }

    public function sssubdestroy($id, $category_id)
    {
        //
       
        $Subategory = Sssubcategory::find($id);
        
        if (count($Subategory) > 0 && $id != 1) {
           

            $Subategory->delete();
            return redirect()->action('CategoriesController@sssubcategory', $category_id)->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategoriesController@sssubcategory', $category_id)->with('doneMessage', trans('backLang.deleteDone'));
        }
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
            'photo' => 'mimes:png,jpeg,jpg,gif|max:3000',
            'category' => 'required',    
        ]);


        // Start of Upload Files
        $formFileName = "photo";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = base_path() . "/public/" . $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        // End of Upload Files

        $Category = new Category;
        $Category->name = $request->category;
        $Category->photo = $fileFinalName_ar;
        $Category->save();

        return redirect()->action('CategoriesController@index')->with('doneMessage', trans('backLang.addDone'));
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
      

        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();

        $Categories = Category::find($id);
 
        if (count($Categories) > 0) {
            return view("backEnd.categories.edit", compact("Categories", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('CategoriesController@index');
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
        $Category = Category::find($id);
        if (count($Category) > 0) {


            $this->validate($request, [
                'photo' => 'mimes:png,jpeg,jpg,gif|max:3000',
                'category' => 'required',
             ]);

            // Start of Upload Files
            $formFileName = "photo";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = base_path() . "/public/" . $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            // End of Upload Files

            //if ($id != 1) {
                $Category->name = $request->category;
                  
             //}
            if ($request->photo_delete == 1) {
                // Delete a Category file
                if ($Category->photo != "") {
                    File::delete($this->getUploadPath() . $Category->photo);
                }

                $Category->photo = "";
            }
            if ($fileFinalName_ar != "") {
                // Delete a Category file
                if ($Category->photo != "") {
                    File::delete($this->getUploadPath() . $Category->photo);
                }

                $Category->photo = $fileFinalName_ar;
            }

            
            $Category->save();
            return redirect()->action('CategoriesController@edit', $id)->with('doneMessage', trans('backLang.saveDone'));
        } else {
            return redirect()->action('CategoriesController@index');
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
       
        $Category = Category::find($id);
        
        if (count($Category) > 0 && $id != 1) {
            // Delete a Category photo
            if ($Category->photo != "") {
                File::delete($this->getUploadPath() . $Category->photo);
            }

            $Category->delete();
            return redirect()->action('CategoriesController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('CategoriesController@index');
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
            User::wherein('id', $request->ids)
                ->update(['status' => 1]);

        } elseif ($request->action == "block") {
            User::wherein('id', $request->ids)->where('id', '!=', 1)
                ->update(['status' => 0]);

        } elseif ($request->action == "delete") {
            // Delete User photo
            $Users = User::wherein('id', $request->ids)->where('id', '!=', 1)->get();
            foreach ($Users as $User) {
                if ($User->photo != "") {
                    File::delete($this->getUploadPath() . $User->photo);
                }
            }

            User::wherein('id', $request->ids)->where('id', "!=", 1)
                ->delete();

        }
        return redirect()->action('UsersController@index')->with('doneMessage', trans('backLang.saveDone'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions_create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        return view("backEnd.users.permissions.create", compact("GeneralWebmasterSections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function permissions_store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data_sections_values = "";
        if (@$request->data_sections != "") {
            foreach ($request->data_sections as $key => $val) {
                $data_sections_values = $val . "," . $data_sections_values;
            }
            $data_sections_values = substr($data_sections_values, 0, -1);
        }

        $Permissions = new Permissions;
        $Permissions->name = $request->name;
        $Permissions->view_status = ($request->view_status) ? "1" : "0";
        $Permissions->add_status = ($request->add_status) ? "1" : "0";
        $Permissions->edit_status = ($request->edit_status) ? "1" : "0";
        $Permissions->delete_status = ($request->delete_status) ? "1" : "0";
        $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
        $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
        $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
        $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
        $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
        $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
        $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
        $Permissions->data_sections = $data_sections_values;
        $Permissions->status = true;
        $Permissions->save();

        return redirect()->action('UsersController@index')->with('doneMessage', trans('backLang.addDone'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_edit($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = Permissions::find($id);
        }
        if (count($Permissions) > 0) {
            return view("backEnd.users.permissions.edit", compact("Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('UsersController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_update(Request $request, $id)
    {
        //
        $Permissions = Permissions::find($id);
        if (count($Permissions) > 0) {


            $this->validate($request, [
                'name' => 'required'
            ]);

            $data_sections_values = "";
            if (@$request->data_sections != "") {
                foreach ($request->data_sections as $key => $val) {
                    $data_sections_values = $val . "," . $data_sections_values;
                }
                $data_sections_values = substr($data_sections_values, 0, -1);
            }

            $Permissions->name = $request->name;
            $Permissions->view_status = ($request->view_status) ? "1" : "0";
            $Permissions->add_status = ($request->add_status) ? "1" : "0";
            $Permissions->edit_status = ($request->edit_status) ? "1" : "0";
            $Permissions->delete_status = ($request->delete_status) ? "1" : "0";
            $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
            $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
            $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
            $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
            $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
            $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
            $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
            $Permissions->data_sections = $data_sections_values;
            $Permissions->status = $request->status;
            if ($id != 1) {
                $Permissions->save();
            }
            return redirect()->action('UsersController@permissions_edit', $id)->with('doneMessage',
                trans('backLang.saveDone'));
        } else {
            return redirect()->action('UsersController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_destroy($id)
    {
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = Permissions::find($id);
        }
        if (count($Permissions) > 0 && $id != 1) {

            $Permissions->delete();
            return redirect()->action('UsersController@index')->with('doneMessage', trans('backLang.deleteDone'));
        } else {
            return redirect()->action('UsersController@index');
        }
    }


}
