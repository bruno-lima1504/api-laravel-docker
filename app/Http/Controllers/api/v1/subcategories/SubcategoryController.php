<?php

namespace App\Http\Controllers\api\v1\subcategories;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $subCategories = Subcategory::all();

            return response()->json(["status" => true, "subCategories" => $subCategories], 200);
        }catch (\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required|max:255",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $subcategory = Subcategory::create($request->all());

            return response()->json($subcategory, 201);

        }catch (\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }       
    }

    public function show($id)
    {
        try{
            $subcategory = Subcategory::find($id);
            return response()->json(["subcategory" => $subcategory], 200);
        }catch (\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        } 
    }

    public function update(Request $request, $id)
    {
        try{
            $subcategory = Subcategory::findOrFail($id);

            $validator = Validator::make($request->all(), [
                "name" => "required|unique:categories|max:255",                
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $subcategory->update($request->all());
    
            return response()->json(['subcategory' => $subcategory], 201);

        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }
   
    public function destroy($id)
    {
        try{
            $subcategory = Subcategory::findOrFail($id);
            $subcategory->delete();
            return response()->json(null, 204);
        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }
}
