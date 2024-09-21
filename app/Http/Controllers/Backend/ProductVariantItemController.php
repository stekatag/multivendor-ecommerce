<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class ProductVariantItemController extends Controller {
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId) {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        return $dataTable->render('admin.product.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId) {
        $variant = ProductVariant::findOrFail($variantId);
        $product = Product::findOrFail($productId);

        return view('admin.product.product-variant-item.create', compact('product', 'variant'));
    }

    public function store(Request $request) {
        $request->validate([
            'variant_id' => ['required', 'integer', 'exists:product_variants,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_default' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);

        $variantItem = new ProductVariantItem();
        $variantItem->product_variant_id = $request->variant_id;
        $variantItem->name = $request->name;
        $variantItem->price = $request->price;
        $variantItem->is_default = $request->is_default;
        $variantItem->status = $request->status;

        $variantItem->save();

        toastr()->success('Product variant item created successfully!');

        return redirect()->route('admin.product-variant-item.index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }
}
