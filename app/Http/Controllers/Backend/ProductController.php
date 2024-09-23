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
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
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
        $product->subcategory_id = $request->subcategory ?? null;
        $product->child_category_id = $request->child_category ?? null;
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
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('subcategory_id', $product->subcategory_id)->get();
        $brands = Brand::where('status', 1)->get();

        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $request->validate([
            'thumb_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
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

        $product = Product::findOrFail($id);

        $imagePath = $this->updateImage($request, 'thumb_image', 'uploads/products/', $product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory ?? null;
        $product->child_category_id = $request->child_category ?? null;
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

        toastr()->success('Product updated successfully!');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $product = Product::findOrFail($id);

        // Delete product thumb image
        $this->deleteImage($product->thumb_image);

        // Delete product gallery images
        $productImageGallery = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($productImageGallery as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }

        // Delete product variants if any
        $variants = ProductVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Brand deleted successfully!']);
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

    public function changeStatus(Request $request) {
        $product = Product::findOrFail($request->id);

        // Explicitly cast the 'status' field to a boolean
        $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);

        if ($request->type === 'status') {
            $product->status = $status ? 1 : 0;
        } else {
            $product->{$request->type} = $status ? 1 : 0; // Dynamically update the relevant field
        }

        $product->save();

        return response(['status' => 'success', 'message' => 'Status updated successfully!']);
    }
}
