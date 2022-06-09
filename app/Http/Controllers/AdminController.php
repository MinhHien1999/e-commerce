<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Session;

class AdminController extends Controller
{
    //
    public function index(){
        return view('backend.index');
    }


}
