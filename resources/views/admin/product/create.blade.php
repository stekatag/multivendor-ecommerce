@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Product</h1>

    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-xl-9 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Product</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.product.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="thumb_image">Thumbnail Image</label>
                  <input type="file" class="form-control" data-tribute="true"
                    name="thumb_image" id="thumb_image">
                </div>
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Samsung TV 69'" name="name" id="name"
                    value="{{ old('name') }}">
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select name="category" id="category"
                        class="form-control main-category">
                        <option value selected>Select a category</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">
                            {{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="subcategory">Subcategory</label>
                      <select name="subcategory" id="subcategory"
                        class="form-control subcategory">
                        <option value selected>Select a subcategory</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="child_category">Child category</label>
                      <select name="child_category" id="child_category"
                        class="form-control child-category">
                        <option value selected>Select a child category</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Create
                  Product</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      $('body').on('change', '.main-category', function(e) {
        let id = $(this).val();

        $.ajax({
          method: 'GET',
          url: "{{ route('admin.product.get-subcategories') }}",
          data: {
            id: id
          },
          success: function(data) {
            $('.subcategory').html(
              '<option value="">Select a subcategory</option>');

            $.each(data, function(key, value) {
              $('.subcategory').append(
                `<option value="${value.id}">${value.name}</option>`
              )
            })
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        })
      })

      // Get child categories
      $('body').on('change', '.subcategory', function(e) {
        let id = $(this).val();

        $.ajax({
          method: 'GET',
          url: "{{ route('admin.product.get-child-categories') }}",
          data: {
            id: id
          },
          success: function(data) {
            $('.child-category').html(
              '<option value="">Select a child category</option>');

            $.each(data, function(key, value) {
              $('.child-category').append(
                `<option value="${value.id}">${value.name}</option>`
              )
            })
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        })
      })
    })
  </script>
@endpush
