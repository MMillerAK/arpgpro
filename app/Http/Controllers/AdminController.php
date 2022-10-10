<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\article;
use App\User;

class AdminController extends Controller
{
    public function index()
    {

        $articles = Article::all();
        $users = [];

       // echo "users: <br>";

        
        foreach($articles as $value )
        {
            //echo
            //;dd($value);
            //;break;
            $user = $value->user;

            if(!in_array($user->user, $users))
            {
                $users[$user->username] = $user;
            }

            
        }

        return view('admin.adminpanel', ['articles' => $articles]);
    }

    
}

