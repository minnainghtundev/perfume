<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function listCategory(){
        $categories = Category::all();
        // return view('category.list-category', compact('categories'));
        return view('category.list-category',['categories' => $categories]);

    }

    public function createCategory(Request $request){
        $validator = validator( request()->all(),
        [
            "name"        => "required",         
            "photo"       => "required",
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $category = new Category();

        $category->name   = request()->name;

        if($request->hasfile('photo'))
        {
            $file       = $request->file('photo');
            $name       = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();

            $file->move('images/category/',$name);

            $category->photo = $name;
        }
        else
        {
            $category->photo='';
        }


        $category->remark = request()->remark;

        $category->save();

        return back()->with('add_info','New Category added Successfully!');

    }

    public function deleteCategory()
    {
        $id = request()->id;
        Category::find($id)->delete();
        return redirect('/admin/category/list')->with('del_info','Category Deleted Successfully!');
    }

    public function updCategory()
    {
        $id = request()->id;
        $category = Category::find($id);
        return view('category.upd-category', [
                            'category' => $category
        ]);
    }

    public function updateCategory(Request $request)
    {
        $validator = validator( request()->all(),
        [
            "name"        => "required",         
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $id = request()->id;
        $category = Category::find($id);

        $category->name   = request()->name;

        if($request->hasfile('photo'))
        {
            $file       = $request->file('photo');
            $name       = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();

            $file->move('images/category/',$name);

            $category->photo = $name;
        }
        
        $category->remark = request()->remark;

        $category->save();

        return redirect('/admin/category/list')->with('upd_info','Category updated Successfully!');
    }
}
