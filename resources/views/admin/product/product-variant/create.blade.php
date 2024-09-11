@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Product Variant</h1>
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
              <h4>Create Product Variant</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.product-variant.store') }}"
                method="POST">
                @csrf

                <input type="hidden" name="product_id"
                  value="{{ request()->product }}">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name"
                    id="name">
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
