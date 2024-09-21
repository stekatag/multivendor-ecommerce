@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Product Variant Items</h1>
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
              <h4>Product Variant: {{ $variant->name }}</h4>
              <div class="card-header-action d-flex">
                <a href="{{ route('admin.product-variant.index', ['product' => $product->id]) }}"
                  class="btn btn-primary d-flex align-items-center mr-2">
                  <i class="fas fa-boxes mr-2"></i>View All Variants
                </a>
                <a href="{{ route('admin.product-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                  class="btn btn-primary d-flex align-items-center">
                  <i class="fas fa-plus-circle mr-2"></i>Create
                  New</a>
              </div>
            </div>

            <div class="card-body">
              <p class="card-text">
                Here you can manage your product variant items.
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
          'type');

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
              'content')
          }
        });

        $.ajax({
          url: "{{ route('admin.product-variant.change-status') }}",
          method: 'PUT',
          data: {
            status: isChecked,
            id: id,
            type: type
          },
          success: function(data) {
            toastr.success(data.message);
            // Dynamically update the switch label text based on the new status
            let switchLabel = isChecked ? 'Active' : 'Inactive';
            // Only update the status label if the switch type is 'status'
            if (type === 'status') {
              $('input[data-id="' + id + '"][data-type="status"]')
                .closest('.custom-switch')
                .find('.custom-switch-description')
                .text(switchLabel);
            }
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        });
      });

    });
  </script>
@endpush
