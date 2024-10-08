@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Brand</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Components</a></div>
        <div class="breadcrumb-item">Table</div>
      </div>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-xl-9 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Brand</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.brand.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="logo">Logo</label>
                  <input type="file" class="form-control" data-tribute="true"
                    name="logo" id="logo" required>
                </div>
                <div class="form-group">
                  <label for="name">Brand name</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Brand Ltd." name="name" id="name"
                    value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                  <label for="is_featured">Featured</label>
                  <select name="is_featured" id="is_featured" class="form-control"
                    required>
                    <option value selected>Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control"
                    required>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Create
                  Brand</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
