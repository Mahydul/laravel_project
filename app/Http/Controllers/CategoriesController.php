<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request()->ajax()) {
            return datatables()->of(Category::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create_category');
    }

    public function saveData(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048'
        );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all(),'status'=>400]);
        }
        if($request->id != 0){
            $categoryId = $request->id;
            //write code for update
            $image = $request->file('image');

            $new_name = rand() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $new_name);
            $update_category = Category::find($categoryId);
            $update_category->name = $request->title;
            $update_category->description = $request->description;
            $update_category->image = $new_name;
            if($update_category->save()){
                return response()->json(['success' => 'Data Updated successfully.','status'=>200]);
            }else{
                return response()->json(['errors' => 'Error in Data Updating.','status'=>500]);
            }

        }else{
            $image = $request->file('image');

            $new_name = rand() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $new_name);
            $form_data = array(
                'name' => $request->title,
                'description' => $request->description,
                'image' => $new_name
            );
            Category::create($form_data);
            return response()->json(['success' => 'Data Added successfully.','status'=>200]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $categoryModel = Category::find($id);
        if(!empty($categoryModel)){
            $data = [
                'status' => 200,
                'id'=>$categoryModel->id,
                'name' => $categoryModel->name,
                'description' => $categoryModel->description
            ];
            return response()->json($data);
        }else{
            return response()->json(['status'=>400,'message'=>'Data Not Found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $category_id = $request->id;
        $delete_category=Category::where('id',$category_id)->delete();
        if($delete_category){
            return response()->json(['status'=>200,'message'=>'Data Deleted Successfully']);
        }else{
            return response()->json(['status'=>400,'message'=>'Error in Data Deleting']);
        }
    }
}
