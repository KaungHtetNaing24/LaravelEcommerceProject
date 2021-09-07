<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required',          
            'description' => 'required',
        ]);
    
       $category = new Category();
       $category->name = $request->input('name');
       $category->slug = $request->input('slug');
       $category->description = $request->input('description');

       $category->save();
       return redirect('/admin/categories')->with('status',"Category Added Successfully");
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id)
    {
        
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required',          
            'description' => 'required',
        ]);
        
        
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->update();
        return redirect('admin/categories')->with('status',"Category updated Successfully");
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/categories')->with('status',"Category Deleted Successfully");
    }
}
