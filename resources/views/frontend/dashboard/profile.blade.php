@extends('frontend.dashboard.layouts.master')

@section('content')
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>basic information</h4>
                <div class="row">

                  <form method="POST" action="{{ route('user.profile.update') }}"
                    enctype="multipart/form-data" class="row">
                    @csrf
                    @method('PUT')

                    <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                      <div class="wsus__dash_pro_img">
                        <img
                          src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/default-user.jpg') }}"
                          alt="img" class="img-fluid w-100">
                        <input type="file" name="image">
                      </div>
                    </div>

                    <div class="col-xl-9">
                      <div class="row">
                        <div class="col-xl-6 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" placeholder="Name"
                              name="name" value="{{ Auth::user()->name }}"
                              required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-6 col-md-6">
                          <div class="wsus__dash_pro_single">
                            <i class="fal fa-envelope-open"></i>
                            <input type="email" placeholder="Email"
                              name="email" value="{{ Auth::user()->email }}"
                              required>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <button class="common_btn mb-4 mt-2" type="submit">save
                          changes</button>
                      </div>
                    </div>
                  </form>

                  <div class="wsus__dash_pass_change mt-2">
                    <div class="row">
                      <div class="col-xl-4 col-md-6">
                        <div class="wsus__dash_pro_single">
                          <i class="fas fa-unlock-alt"></i>
                          <input type="password" placeholder="Current Password">
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6">
                        <div class="wsus__dash_pro_single">
                          <i class="fas fa-lock-alt"></i>
                          <input type="password" placeholder="New Password">
                        </div>
                      </div>
                      <div class="col-xl-4">
                        <div class="wsus__dash_pro_single">
                          <i class="fas fa-lock-alt"></i>
                          <input type="password" placeholder="Confirm Password">
                        </div>
                      </div>
                      <div class="col-xl-12">
                        <button class="common_btn" type="submit">save
                          changes</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
