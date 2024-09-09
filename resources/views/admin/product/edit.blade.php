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
              <h4>Edit Product</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.product.update', $product->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label>Thumbnail Image Preview</label>
                  <img width="200px" src="{{ asset($product->thumb_image) }}"
                    alt="Thumbnail Image" class="img-thumbnail d-block">
                </div>
                <div class="form-group">
                  <label for="thumb_image">Thumbnail Image</label>
                  <input type="file" class="form-control" data-tribute="true"
                    name="thumb_image" id="thumb_image">
                </div>
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Samsung TV 69'" name="name" id="name"
                    value="{{ $product->name }}" required>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select name="category" id="category"
                        class="form-control main-category" required>
                        <option value selected>Select a category</option>
                        @foreach ($categories as $category)
                          <option
                            {{ $category->id == $product->category_id ? 'selected' : '' }}
                            value="{{ $category->id }}">
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
                        @foreach ($subcategories as $subcategory)
                          <option
                            {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}
                            value="{{ $subcategory->id }}">
                            {{ $subcategory->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="child_category">Child category</label>
                      <select name="child_category" id="child_category"
                        class="form-control child-category">
                        <option value selected>Select a child category</option>
                        @foreach ($childCategories as $childCategory)
                          <option
                            {{ $childCategory->id == $product->child_category_id ? 'selected' : '' }}
                            value="{{ $childCategory->id }}">
                            {{ $childCategory->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="brand">Brand</label>
                  <select name="brand" id="brand" class="form-control brand"
                    required>
                    <option value selected>Select a brand</option>
                    @foreach ($brands as $brand)
                      <option
                        {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                        value="{{ $brand->id }}">{{ $brand->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="sku">Product SKU</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Enter a SKU" name="sku" id="sku"
                    value="{{ $product->sku }}">
                </div>

                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Enter a product price" name="price"
                    id="price" value="{{ $product->price }}" required>
                </div>

                <div class="form-group">
                  <label for="offer_price">Offer Price</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Enter offer price" name="offer_price"
                    id="offer_price" value="{{ $product->offer_price }}">
                </div>

                <div class="form-group">
                  <label for="offer_date_range">Offer Date Range</label>
                  <input type="text" class="form-control" data-tribute="true"
                    name="offer_date_range" id="offer_date_range" value=""
                    placeholder="Select offer date range" />
                  <input type="hidden" name="offer_start_date"
                    id="offer_start_date" value="">
                  <input type="hidden" name="offer_end_date"
                    id="offer_end_date" value="">
                </div>

                <div class="form-group">
                  <label for="qty">Stock Quantity</label>
                  <input type="number" min="0" class="form-control"
                    data-tribute="true" placeholder="Enter stock quantity"
                    name="qty" id="qty" value="{{ $product->qty }}"
                    required>
                </div>

                <div class="form-group">
                  <label for="video_link">Video Link</label>
                  <input type="text" class="form-control"
                    data-tribute="true" placeholder="Enter a video URL"
                    name="video_link" id="video_link"
                    value="{{ $product->video_link }}">
                </div>

                <div class="form-group">
                  <label for="short_description">Short description</label>
                  <textarea name="short_description" id="short_description" required
                    placeholder="Enter a short description" class="form-control">{!! $product->short_description !!}</textarea>
                </div>

                <div class="form-group">
                  <label for="long_description">Long description</label>
                  <textarea name="long_description" id="long_description"
                    class="form-control summernote">{!! $product->long_description !!}</textarea>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_new">Is New </label>
                      <select name="is_new" id="is_new"
                        class="form-control" required>
                        <option value selected>Select an option</option>
                        <option {{ $product->is_new == 1 ? 'selected' : '' }}
                          value="1">Yes</option>
                        <option {{ $product->is_new == 0 ? 'selected' : '' }}
                          value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_top">Is Top </label>
                      <select name="is_top" id="is_top"
                        class="form-control" required>
                        <option value selected>Select an option</option>
                        <option {{ $product->is_top == 1 ? 'selected' : '' }}
                          value="1">Yes</option>
                        <option {{ $product->is_top == 0 ? 'selected' : '' }}
                          value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_best">Is Best </label>
                      <select name="is_best" id="is_best"
                        class="form-control" required>
                        <option value selected>Select an option</option>
                        <option {{ $product->is_best == 1 ? 'selected' : '' }}
                          value="1">Yes</option>
                        <option {{ $product->is_best == 0 ? 'selected' : '' }}
                          value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_featured">Is Featured </label>
                      <select name="is_featured" id="is_featured"
                        class="form-control" required>
                        <option value selected>Select an option</option>
                        <option
                          {{ $product->is_featured == 1 ? 'selected' : '' }}
                          value="1">Yes</option>
                        <option
                          {{ $product->is_featured == 0 ? 'selected' : '' }}
                          value="0">No</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="seo_title">SEO Title</label>
                  <input type="text" class="form-control"
                    data-tribute="true" placeholder="Enter a SEO title"
                    name="seo_title" id="seo_title"
                    value="{{ $product->seo_title }}">
                </div>

                <div class="form-group">
                  <label for="seo_description">SEO Description</label>
                  <input type="text" class="form-control"
                    data-tribute="true" placeholder="Enter a SEO description"
                    name="seo_description" id="seo_description"
                    value="{{ $product->seo_description }}">
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control"
                    required>
                    <option {{ $product->status == 1 ? 'selected' : '' }}
                      value="1">Active</option>
                    <option {{ $product->status == 0 ? 'selected' : '' }}
                      value="0">Inactive</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Edit
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
      // When main category changes, clear both subcategory and child category fields
      $('body').on('change', '.main-category', function(e) {
        let id = $(this).val();

        // Clear the subcategory and child-category fields first
        $('.subcategory').html(
          '<option value="">Select a subcategory</option>');
        $('.child-category').html(
          '<option value="">Select a child category</option>');

        // Fetch new subcategories based on the selected main category
        $.ajax({
          method: 'GET',
          url: "{{ route('admin.product.get-subcategories') }}",
          data: {
            id: id
          },
          success: function(data) {
            // Populate subcategory options
            $.each(data, function(key, value) {
              $('.subcategory').append(
                `<option value="${value.id}">${value.name}</option>`
              );
            });
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        });
      });

      // When subcategory changes, fetch child categories
      $('body').on('change', '.subcategory', function(e) {
        let id = $(this).val();

        // Clear the child-category field first
        $('.child-category').html(
          '<option value="">Select a child category</option>');

        // Fetch new child categories based on the selected subcategory
        $.ajax({
          method: 'GET',
          url: "{{ route('admin.product.get-child-categories') }}",
          data: {
            id: id
          },
          success: function(data) {
            // Populate child category options
            $.each(data, function(key, value) {
              $('.child-category').append(
                `<option value="${value.id}">${value.name}</option>`
              );
            });
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        });
      });

      // Date range picker initialization with pre-selected values from the database
      var startDate =
        "{{ $product->offer_start ? $product->offer_start : null }}";
      var endDate = "{{ $product->offer_end ? $product->offer_end : null }}";

      if (startDate && endDate) {
        // Initialize with values if dates exist
        $('#offer_date_range').daterangepicker({
          startDate: moment(startDate, 'YYYY-MM-DD'),
          endDate: moment(endDate, 'YYYY-MM-DD'),
          locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: 'Clear'
          },
          opens: 'center'
        });
        // Set the initial input value
        $('#offer_date_range').val(startDate + ' - ' + endDate);
      } else {
        // Initialize without pre-filled values
        $('#offer_date_range').daterangepicker({
          autoUpdateInput: false,
          locale: {
            cancelLabel: 'Clear'
          },
          opens: 'center'
        });
      }

      // When date is selected
      $('#offer_date_range').on('apply.daterangepicker', function(ev,
        picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker
          .endDate.format('YYYY-MM-DD'));
      });

      // When clear is clicked
      $('#offer_date_range').on('cancel.daterangepicker', function(ev,
        picker) {
        $(this).val(''); // Clear input
      });

      // Handle form submission if you need to split the date range into two fields
      $('form').on('submit', function(e) {
        let range = $('#offer_date_range').val();
        if (range) {
          let dates = range.split(' - ');
          $('input[name="offer_start_date"]').val(dates[0]);
          $('input[name="offer_end_date"]').val(dates[1]);
        }
      });
    });
  </script>
@endpush
