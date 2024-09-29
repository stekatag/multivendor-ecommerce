@extends('vendor.layouts.master')

@section('content')
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>Products</h3>
            <div class="d-flex justify-content-start justify-content-md-end">
              <a href="{{ route('vendor.product.create') }}"
                class="btn btn-primary mb-2">Create New</a>
            </div>

            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{ $dataTable->table() }}
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
