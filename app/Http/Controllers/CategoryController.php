<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Validator;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function categoriesView()
    {
        $categories = $this->category->paginate(8);
        return view('admin.view-categories',compact('categories'));
    }

    public function addCategoryView()
    {
        return view('admin.add-category');
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:2',
            'name_spanish'=>'required|min:2',
            'name_french'=>'required|min:2',
        ]);
        $data = $request->all();
        $create = $this->category->createCategory($data);
        if($create){
            Session::flash('success','Category Add Successfully');
            return back();
        }else{
            Session::flash('error','Failed Try Again Later');
            return back();
        }
    }

    public function deleteCategory($id)
    {
        $delete = $this->category->deleteCategory($id);
        if($delete){
            Session::flash('success','Category Delete Successfully');
            return back();
        }else{
            Session::flash('error','failed Try Again Later');
            return back();
        }
    }

    public function editCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'name_spanish'=>'required',
            'name_french'=>'required',
        ]);
        $formData = $request->all();
        $id = $formData['category_id'];
        $updateData = $request->except('category_id','_token');
        $update = $this->category->updateCategory($id,$updateData);
        if($update){
            Session::flash('success','Category Update Successfully');
            return back();
        }else{
            Session::flash('error','Failed Try Again Later');
            return back();
        }
    }
}
