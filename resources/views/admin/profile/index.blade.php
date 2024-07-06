@extends('admin.layouts.master')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="post" class="needs-validation" novalidate=""
              action="{{ route('admin.profile.update') }}"
              enctype="multipart/form-data">
              @csrf

              <div class="card-header">
                <h4>Edit Profile</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-12">
                    <div class="mb-3">
                      <img alt="profile image" width="100"
                        class="d-block rounded"
                        src="{{ asset(Auth::user()->image) }}" width="100">
                    </div>
                    <label for="image">Profile Image (Max 2MB)</label>
                    <input id="image" type="file" name="image"
                      class="form-control" value="{{ Auth::user()->image }}"
                      required="">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name"
                      class="form-control" value="{{ Auth::user()->name }}"
                      required="">
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label for="email">Email</label>
                    <input id="email" type="text" name="email"
                      class="form-control" value="{{ Auth::user()->email }}"
                      required="">
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
