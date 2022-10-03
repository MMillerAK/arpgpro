<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{

    //Create entries
    public function createItem()
    {
        return view('gamedata.createItem');
    }

    public function storeItem(Request $request)
    {             
        

        
        
        redirect("/admin/index")->send();
    }



    //ViewEntries

    public function viewItem($itemID)
    {

    }
}
