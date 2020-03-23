<?php

namespace App\Http\Controllers;

use App\Model\Uom;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function saveData(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all(), 'status' => 400]);
        }
        if ($request->id != 0) {
            $uomId = $request->id;
            $uom_model = Uom::find($uomId);
            $uom_model->name = $request->name;
            $uom_model->description = $request->description;
            if ($uom_model->save()) {
                return response()->json(['success' => 'Successfully Updated', 'status' => 200]);
            } else {
                return response()->json(['errors' => 'Error in updating', 'status' => 400]);
            }
        } else {
            $uom = new Uom();
            $uom->name = $request->name;
            $uom->description = $request->description;
            if ($uom->save()) {
                return response()->json(['success' => 'Successfully Created', 'status' => 200]);
            } else {
                return response()->json(['error' => 'Error in saving', 'status' => 400]);
            }
        }

    }

    public function update(Request $request)
    {
        $uom_model = Uom::find($request->id);
        if (!empty($uom_model)) {
            $data = [
                'status' => 200,
                'id' => $uom_model->id,
                'name' => $uom_model->name,
                'description' => $uom_model->description
            ];
            return response()->json($data);
        } else {
            $data = [
                'status' => 400,
                'errors' => 'Data Not Found'
            ];
            return response()->json($data);
        }

    }

    public function delete(Request $request)
    {
        $delete_uom = Uom::where('id',$request->id)->delete();
        if($delete_uom){
            return response()->json(['status'=>200,'message'=>'Successfully deleted']);
        }else{
            return response()->json(['status'=>200,'message'=>'Error in deleting']);
        }
    }
}
