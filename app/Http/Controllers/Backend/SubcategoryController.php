<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SubcategoryDataTable;
use App\Models\ChildCategory;

class SubcategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(SubcategoryDataTable $dataTable) {
        return $dataTable->render('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::where('status', true)->get();
        return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'name' => ['required', 'max:255', 'unique:subcategories,name'],
            'status' => ['required'],
        ]);

        $subcategory = new Subcategory();

        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr()->success('Subcategory created successfully!');

        return redirect()->route('admin.subcategory.index');
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
        $categories = Category::where('status', true)->get();
        $subcategory = Subcategory::findOrFail($id);

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $request->validate([
            'category' => ['required', 'exists:categories,id'],
            'name' => ['required', 'max:255', 'unique:subcategories,name,' . $id],
            'status' => ['required'],
        ]);

        $subcategory = Subcategory::findOrFail($id);

        $subcategory->category_id = $request->category;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name);
        $subcategory->status = $request->status;

        $subcategory->save();

        toastr()->success('Subcategory updated successfully!');

        return redirect()->route('admin.subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $subcategory = Subcategory::findOrFail($id);
        $childCategory = ChildCategory::where('subcategory_id', $subcategory->id)->count();

        if ($childCategory > 0) {
            return response(['status' => 'error', 'message' => 'This subcategory cannot be deleted, because it has child categories! To delete this subcategory, you must delete all related child categories first.']);
        }

        $subcategory->delete();

        return response(['status' => 'success', 'message' => 'Subcategory deleted successfully!']);
    }

    public function changeStatus(Request $request) {
        $subcategory = Subcategory::findOrFail($request->id);
        $subcategory->status = $request->status == 'true' ? 1 : 0;
        $subcategory->save();

        return response(['status' => 'success', 'message' => 'Status updated successfully!']);
    }
}
