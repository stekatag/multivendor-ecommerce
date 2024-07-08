@extends('frontend.layouts.master')

@section('content')
  <section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h4>change password</h4>
            <ul>
              <li><a href="#">login</a></li>
              <li><a href="#">change password</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  \
  <section id="wsus__login_register">
    <div class="container">
      <div class="row">
        <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
          <form form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token"
              value="{{ $request->route('token') }}">

            <div class="wsus__change_password">
              <h4>Reset password</h4>
              <div class="wsus__single_pass">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                  placeholder="Email" value="{{ old('email', $request->email) }}"
                  required>
              </div>

              <div class="wsus__single_pass">
                <label for="password">new password</label>
                <input id="password" name="password" type="password"
                  placeholder="New Password" required autocomplete="new-password">
              </div>

              <div class="wsus__single_pass">
                <label for="password_confirmation">confirm password</label>
                <input id="password_confirmation" name="password_confirmation"
                  type="password" placeholder="Confirm Password" required
                  autocomplete="new-password">
              </div>

              <button class="common_btn" type="submit">submit</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
