<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {

        dd('test')
        return('admin.AdminPanel');
    }

    
}

