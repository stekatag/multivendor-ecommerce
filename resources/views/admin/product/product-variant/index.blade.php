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
              <h4>Product: {{ $product->name }}</h4>
              <div class="card-header-action d-flex">
                <a href="{{ route('admin.product.index') }}"
                  class="btn btn-primary d-flex align-items-center mr-2">
                  <i class="fas fa-boxes mr-2"></i>View All Products
                </a>
                <a href="{{ route('admin.product-variant.create', ['product' => request()->product]) }}"
                  class="btn btn-primary d-flex align-items-center">
                  <i class="fas fa-plus-circle mr-2"></i>Create
                  New</a>
              </div>
            </div>

            <div class="card-body">
              <p class="card-text">
                Here you can manage your product variants.
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

  <script>
    $(document).ready(function() {
      // Change the status or any of the switches with the toggle
      $('body').on('click', '.change-switch', function() {
        let isChecked = $(this).prop('checked');
        let id = $(this).data('id');
        let type = $(this).data(
          'type'); // This can be is_new, is_top, is_best, or is_featured

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
              'content')
          }
        });

        $.ajax({
          url: "{{ route('admin.product.change-status') }}",
          method: 'PUT',
          data: {
            status: isChecked,
            id: id,
            type: type
          },
          success: function(data) {
            toastr.success(data.message);
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        });
      });

    });
  </script>
@endpush
