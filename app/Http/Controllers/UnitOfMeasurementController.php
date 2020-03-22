<?php

namespace App\Http\Controllers;

use App\Model\Uom;
use Illuminate\Http\Request;

class UnitOfMeasurementController extends Controller
{
    //
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Uom::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('uom.index');
    }

    public function saveData()
    {

    }
}
