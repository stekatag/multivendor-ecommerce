@extends('vendor.layouts.master')

@section('content')
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Create Product</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{ route('vendor.product.store') }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf

                  <div class="form-group wsus__input">
                    <label for="thumb_image">Thumbnail Image</label>
                    <input type="file" class="form-control" data-tribute="true"
                      name="thumb_image" id="thumb_image" required>
                  </div>
                  <div class="form-group wsus__input">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" data-tribute="true"
                      placeholder="Samsung TV 69'" name="name" id="name"
                      value="{{ old('name') }}" required>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group wsus__input">
                        <label for="category">Category</label>
                        <select name="category" id="category"
                          class="form-control main-category" required>
                          <option value selected>Select a category</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                              {{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group wsus__input">
                        <label for="subcategory">Subcategory</label>
                        <select name="subcategory" id="subcategory"
                          class="form-control subcategory">
                          <option value selected>Select a subcategory</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group wsus__input">
                        <label for="child_category">Child category</label>
                        <select name="child_category" id="child_category"
                          class="form-control child-category">
                          <option value selected>Select a child category</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group wsus__input">
                    <label for="brand">Brand</label>
                    <select name="brand" id="brand"
                      class="form-control brand" required>
                      <option value selected>Select a brand</option>
                      @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group wsus__input">
                    <label for="sku">Product SKU</label>
                    <input type="text" class="form-control" data-tribute="true"
                      placeholder="Enter a SKU" name="sku" id="sku"
                      value="{{ old('sku') }}">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" data-tribute="true"
                      placeholder="Enter a product price" name="price"
                      id="price" value="{{ old('price') }}" required>
                  </div>

                  <div class="form-group wsus__input">
                    <label for="offer_price">Offer Price</label>
                    <input type="text" class="form-control" data-tribute="true"
                      placeholder="Enter offer price" name="offer_price"
                      id="offer_price" value="{{ old('offer_price') }}">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="offer_date_range">Offer Date Range</label>
                    <input type="text" class="form-control" data-tribute="true"
                      name="offer_date_range" id="offer_date_range" value=""
                      placeholder="Select offer date range" />
                    <input type="hidden" name="offer_start_date"
                      id="offer_start_date" value="">
                    <input type="hidden" name="offer_end_date"
                      id="offer_end_date" value="">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="qty">Stock Quantity</label>
                    <input type="number" min="0" class="form-control"
                      data-tribute="true" placeholder="Enter stock quantity"
                      name="qty" id="qty" value="{{ old('qty') }}"
                      required>
                  </div>

                  <div class="form-group wsus__input">
                    <label for="video_link">Video Link</label>
                    <input type="text" class="form-control"
                      data-tribute="true" placeholder="Enter a video URL"
                      name="video_link" id="video_link"
                      value="{{ old('video_link') }}">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="short_description">Short description</label>
                    <textarea name="short_description" id="short_description" required
                      placeholder="Enter a short description" class="form-control"></textarea>
                  </div>

                  <div class="form-group wsus__input mb-4">
                    <label for="long_description">Long description</label>
                    <textarea name="long_description" id="long_description"
                      class="form-control summernote"></textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group wsus__input">
                        <label for="is_new">Is New </label>
                        <select name="is_new" id="is_new"
                          class="form-control" required>
                          <option value selected>Select an option</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group wsus__input">
                        <label for="is_top">Is Top </label>
                        <select name="is_top" id="is_top"
                          class="form-control" required>
                          <option value selected>Select an option</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group wsus__input">
                        <label for="is_best">Is Best </label>
                        <select name="is_best" id="is_best"
                          class="form-control" required>
                          <option value selected>Select an option</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group wsus__input">
                        <label for="is_featured">Is Featured </label>
                        <select name="is_featured" id="is_featured"
                          class="form-control" required>
                          <option value selected>Select an option</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group wsus__input">
                    <label for="seo_title">SEO Title</label>
                    <input type="text" class="form-control"
                      data-tribute="true" placeholder="Enter a SEO title"
                      name="seo_title" id="seo_title"
                      value="{{ old('seo_title') }}">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="seo_description">SEO Description</label>
                    <input type="text" class="form-control"
                      data-tribute="true" placeholder="Enter a SEO description"
                      name="seo_description" id="seo_description"
                      value="{{ old('seo_description') }}">
                  </div>

                  <div class="form-group wsus__input">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control"
                      required>
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
          url: "{{ route('vendor.product.get-subcategories') }}",
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
          url: "{{ route('vendor.product.get-child-categories') }}",
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

      // Date range picker logic
      $('#offer_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Clear'
        },
        singleDatePicker: false, // This makes it a range picker
        opens: 'center',
      });

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
