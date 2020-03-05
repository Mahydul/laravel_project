<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryTypeController extends Controller
{
    //
    public function index()
    {
        return view('inventory.inventory_type_list');
    }
}
