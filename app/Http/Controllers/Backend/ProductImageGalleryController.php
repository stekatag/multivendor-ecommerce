<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductImageGalleryDataTable;
use App\Models\ProductImageGallery;
use App\Traits\ImageUploadTrait;

class ProductImageGalleryController extends Controller {
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductImageGalleryDataTable $dataTable) {
        $product = Product::findOrFail($request->product);
        $allowedMimeTypes = ['jpeg', 'png', 'jpg', 'gif', 'webp'];
        return $dataTable->render('admin.product-image-gallery.index', compact('product', 'allowedMimeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'image.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        // Handle multiple image upload
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads/products');

        foreach ($imagePaths as $imagePath) {
            $productImageGallery = new ProductImageGallery();
            $productImageGallery->image = $imagePath;
            $productImageGallery->product_id = $request->product_id;
            $productImageGallery->save();
        }

        toastr()->success('Upload successful!');
        return redirect()->back();
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
        $productGalleryImage = ProductImageGallery::findOrFail($id);
        $this->deleteImage($productGalleryImage->image);
        $productGalleryImage->delete();

        return response(['status' => 'success', 'message' => 'Image deleted successfully!']);
    }
}
