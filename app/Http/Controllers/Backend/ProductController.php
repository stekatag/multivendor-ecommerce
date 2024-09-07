<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Traits\ImageUploadTrait;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable) {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'thumb_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'video_link' => ['nullable', 'url'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'is_new' => ['required'],
            "is_top" => ['required'],
            'is_featured' => ['required'],
            'is_best' => ['required'],
            'seo_title' => ['nullable', 'max:255'],
            'seo_description' => ['nullable', 'max:350'],
            'status' => ['required'],
        ]);

        $product = new Product();

        $imagePath = $this->uploadImage($request, 'thumb_image', 'uploads/products/');

        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start = $request->offer_start_date;
        $product->offer_end = $request->offer_end_date;
        $product->is_new = $request->is_new;
        $product->is_top = $request->is_top;
        $product->is_best = $request->is_best;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;

        $product->save();

        toastr()->success('Product added successfully!');

        return redirect()->route('admin.product.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    /**
     * Get all product subcategories
     */
    public function getSubcategories(Request $request) {
        $subcategories = Subcategory::where('category_id', $request->id)->get();
        return $subcategories;
    }

    /**
     * Get all product child categories
     */
    public function getChildCategories(Request $request) {
        $childCategories = ChildCategory::where('subcategory_id', $request->id)->get();
        return $childCategories;
    }
}
