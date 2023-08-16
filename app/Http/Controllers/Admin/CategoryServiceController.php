<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\CategoryServiceFormRequest;
use App\Http\Controllers\Controller;
use App\Models\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryServiceController extends Controller
{
    public function index()
    {
        return view('admin.servicescategories.index');
    }
    public function create()
    {
        return view('admin.servicescategories.create');
    }
    public function store(CategoryServiceFormRequest $request)
    {
        $validatedData = $request->validated();
        $categoryservice = new CategoryService;
        $categoryservice->name = $validatedData['name'];
        $categoryservice->slug = Str::slug($validatedData['name']);
        $categoryservice->status = $request->status == true ? '1':'0';
        $categoryservice->save();
        return redirect('admin/service/category')->with('message','Category Added Successfully');
    }
    public function edit(CategoryService $category)
    {
        return view('admin.servicescategories.edit',compact('category'));
    }
    public function update(CategoryServiceFormRequest $request , $category)
    {
        $validatedData = $request->validated();
        $categoryservice = CategoryService::findOrFail($category);
        $categoryservice->name = $validatedData['name'];
        $categoryservice->slug = Str::slug($validatedData['name']);
        $categoryservice->status = $request->status == true ? '1':'0';
        $categoryservice->update();
        return redirect('admin/service/category')->with('message','Category Updated Successfully');
    }
    public function delete($category)
    {
        $categoryservice = CategoryService::find($category);
        $categoryservice->delete();
        return redirect('admin/service/category')->with('message','Category Deleted');
        $this->dispatchBrowserEvent('close-modal');
    }
}
