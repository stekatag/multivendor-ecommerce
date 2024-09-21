@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Product Variant Item</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Components</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Product Variant Item</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.product-variant-item.store') }}"
                method="POST">
                @csrf

                <input type="hidden" name="variant_id"
                  value="{{ $variant->id }}">
                <input type="hidden" name="product_id"
                  value="{{ $product->id }}">

                <div class="form-group">
                  <label for="variant-name">Variant Name</label>
                  <input type="text" class="form-control" name="variant-name"
                    id="variant-name" value="{{ $variant->name }}" readonly>
                </div>

                <div class="form-group">
                  <label for="name">Item Name</label>
                  <input type="text" class="form-control" name="name"
                    id="name" required>
                </div>

                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" name="price"
                    id="price" required>
                </div>

                <div class="form-group">
                  <label for="is_default">Is Default?</label>
                  <select name="is_default" id="is_default" class="form-control"
                    required>
                    <option value selected>Select an option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <button class="btn btn-primary" type="submit">Create</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
