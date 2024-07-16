@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Category</h1>
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
              <h4>Edit Category</h4>
            </div>

            <div class="card-body">
              <form action="{{ route('admin.category.update', $category->id) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label class="d-block" for="icon">Icon</label>
                  <button class="btn btn-primary" data-iconset="fontawesome5"
                    data-icon="{{ $category->icon }}"
                    data-unselected-class="btn-light" role="iconpicker"
                    name="icon" id="icon"></button>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name"
                    id="name" value="{{ $category->name }}">
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option {{ $category->status == 1 ? 'selected' : '' }}
                      value="1" selected>Active</option>
                    <option {{ $category->status == 0 ? 'selected' : '' }}
                      value="0">Inactive</option>
                  </select>
                </div>

                <button class="btn btn-primary" type="submit">Save
                  Changes</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
