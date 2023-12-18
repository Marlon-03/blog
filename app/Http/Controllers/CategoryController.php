<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $name = $request->input('name');
        $category = new Category();
        $category->name = $name;

        if ($category->save()) {
            return response()->json(['message' => 'Category created successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to create category'], 500);
        }
    }

    public function index(){
        return Category::latest()->get();
    }

    public function show($id){
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);
    
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        $category->name = $request->input('name');
        $category->save();
    
        return response()->json(['message' => 'Category updated successfully'], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        if ($category->delete()) {
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete category'], 500);
        }
    }
}
