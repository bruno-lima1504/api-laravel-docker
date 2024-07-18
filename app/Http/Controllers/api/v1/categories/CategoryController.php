<?php

namespace App\Http\Controllers\api\v1\categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            $categories = Category::with("subcategory")->get();

            return response()->json(["status" => true, "categories" => $categories], 200);
        }catch (\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                "name" => "required|unique:categories|max:255",
                "id_subcategory" => "nullable|exists:subcategories,id_subcategory",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $category = Category::create($request->all());
    
            return response()->json(["category" => $category], 201);

        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try{
          $category = Category::where("id_category", $id)
            ->with("subcategory") 
            ->get();
    
           return response()->json(["category" => $category], 200);

        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $category = Category::findOrFail($id);

            $validator = Validator::make($request->all(), [
                "name" => "required|unique:categories|max:255",
                "id_subcategory" => "nullable|exists:subcategories,id_subcategory",
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $category->update($request->all());
    
            return response()->json(['category' => $category], 201);

        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(null, 204);
        }catch(\Exception $e){
            return response()->json(["status" => false, "message" => $e->getMessage()], 500);
        }
    }
}
