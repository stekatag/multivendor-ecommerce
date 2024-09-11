@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Product Image Gallery</h1>
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
              <h4>Product: {{ $product->name }}</h4>
              <div class="card-header-action">
                <a href="{{ route('admin.product.index') }}">
                  <button class="btn btn-primary ">View All Products</button>
                </a>
              </div>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.product-image-gallery.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" name="image[]" id="image"
                    class="form-control" required multiple
                    accept="{{ '.' . implode(',.', $allowedMimeTypes) }}">
                  <input type="hidden" name="product_id"
                    value="{{ $product->id }}">
                </div>
                <button class="btn btn-primary" type="submit">Upload</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Images</h4>
            </div>

            <div class="card-body">
              <p class="card-text">
                Here you can manage your products.
              </p>
              <div class="table-responsive">

                <table class="table">

                  {{ $dataTable->table() }}
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
