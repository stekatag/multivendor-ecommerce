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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Brands Table</h4>
              <div class="card-header-action">
                <a href="{{ route('admin.brand.create') }}"
                  class="btn btn-primary d-flex align-items-center"><i
                    class="fas fa-plus-circle mr-2"></i>Create
                  New</a>
              </div>
            </div>

            <div class="card-body">
              <p class="card-text">
                Here you can manage all brands.
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
      @if (session()->has('reload'))
        // Trigger a page reload to ensure everything is displayed correctly
        window.location.reload();
      @endif

      // Change the status of the category with the toggle switch
      $('body').on('click', '.change-status', function() {
        let isChecked = $(this).prop('checked');
        let id = $(this).data('id');

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
              'content')
          }
        });

        $.ajax({
          url: "{{ route('admin.brand.change-status') }}",
          method: 'PUT',
          data: {
            status: isChecked,
            id: id
          },
          success: function(data) {
            toastr.success(data.message);
          },
          error: function(xhr, status, error) {
            toastr.error('An error occurred: ' + error);
          }
        });

        // Change the description based on the status
        $(this).parent().parent().find('.custom-switch-description')
          .text(isChecked ? 'Active' : 'Inactive');
      })
    });
  </script>
@endpush
