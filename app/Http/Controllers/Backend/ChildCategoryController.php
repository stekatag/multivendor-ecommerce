<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ChildCategoryDataTable;

class ChildCategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable) {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Get subcategories by category id
     */
    public function getSubcategories(Request $request) {
        $subcategories = Subcategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subcategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'subcategory' => ['required', 'exists:subcategories,id'],
            'name' => ['required', 'max:255', 'unique:child_categories,name'],
            'status' => ['required'],
        ]);

        $childCategory = new ChildCategory();

        $childCategory->category_id = $request->category;
        $childCategory->subcategory_id = $request->subcategory;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;

        $childCategory->save();

        toastr()->success('Child Category created successfully!');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $categories = Category::all();
        $childCategory = ChildCategory::findOrFail($id);
        $subcategories = Subcategory::where('category_id', $childCategory->category_id)->where('status', 1)->get();

        return view('admin.child-category.edit', compact('categories', 'childCategory', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'subcategory' => ['required', 'exists:subcategories,id'],
            'name' => ['required', 'max:255', 'unique:child_categories,name,' . $id],
            'status' => ['required'],
        ]);

        $childCategory = ChildCategory::findOrFail($id);

        $childCategory->category_id = $request->category;
        $childCategory->subcategory_id = $request->subcategory;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;

        $childCategory->save();

        toastr()->success('Child Category updated successfully!');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['status' => 'success', 'message' => 'Child Category deleted successfully!']);
    }

    public function changeStatus(Request $request) {
        $subcategory = ChildCategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();

        return response(['status' => 'success', 'message' => 'Status updated successfully!']);
    }
}
