<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantDataTable;

class ProductVariantController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable) {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.product-variant.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required']
        ]);

        $productVariant = new ProductVariant();
        $productVariant->product_id = $request->product_id;
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        toastr()->success('Product variant created successfully');

        return redirect()->route('admin.product-variant.index', ['product' => $request->product_id]);
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
        $productVariant = ProductVariant::findOrFail($id);
        return view('admin.product.product-variant.edit', compact('productVariant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required']
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->name = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        toastr()->success('Product variant updated successfully');

        return redirect()->route('admin.product-variant.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();

        return response(['status' => 'success', 'message' => 'Product variant deleted successfully']);
    }

    public function changeStatus(Request $request) {
        $productVariant = ProductVariant::findOrFail($request->id);

        // Explicitly cast the 'status' field to a boolean
        $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
        $productVariant->status = $status ? 1 : 0;
        $productVariant->save();

        return response(['status' => 'success', 'message' => 'Status updated successfully!']);
    }
}
