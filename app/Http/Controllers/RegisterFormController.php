<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Menu;
use App\WebmasterSection;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class RegisterFormController extends Controller
{

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
    public function index($ParentMenuId = 0)
    {
        return view("auth.register");
    }
    

}