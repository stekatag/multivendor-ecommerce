@extends('frontend.layouts.master')

@section('content')
  <section id="wsus__breadcrumb">
    <div class="wsus_breadcrumb_overlay">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h4>login / register</h4>
            <ul>
              <li><a href="#">home</a></li>
              <li><a href="#">login / register</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="wsus__login_register">
    <div class="container">
      <div class="row">
        <div class="col-xl-5 m-auto">
          <div class="wsus__login_reg_area">
            <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link {{ session('tab') == 'signup' ? '' : 'active' }}"
                  id="pills-home-tab2" data-bs-toggle="pill"
                  data-bs-target="#pills-login" type="button" role="tab"
                  aria-controls="pills-login" aria-selected="true">login</button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link {{ session('tab') == 'signup' ? 'active' : '' }}"
                  id="pills-profile-tab2" data-bs-toggle="pill"
                  data-bs-target="#pills-signup" type="button" role="tab"
                  aria-controls="pills-signup"
                  aria-selected="true">signup</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent2">
              <div
                class="tab-pane fade {{ session('tab') == 'signup' ? '' : 'show active' }}"
                id="pills-login" role="tabpanel"
                aria-labelledby="pills-home-tab2">
                <div class="wsus__login">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="wsus__login_input">
                      <i class="fas fa-user-tie"></i>
                      <input id="email" name="email"
                        value="{{ old('email') }}" type="email"
                        placeholder="Email" required autocomplete="email">
                    </div>
                    <div class="wsus__login_input">
                      <i class="fas fa-key"></i>
                      <input id="password" name="password" type="password"
                        placeholder="Password" required
                        autocomplete="current-password">
                    </div>
                    <div class="wsus__login_save">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                          id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember
                          me</label>
                      </div>
                      <a class="forget_p"
                        href="{{ route('password.request') }}">Forgot
                        password?</a>
                    </div>
                    <button class="common_btn" type="submit">login</button>
                    <p class="social_text">Sign in with social account</p>
                    <ul class="wsus__login_link">
                      <li><a href="#"><i class="fab fa-google"></i></a></li>
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a>
                      </li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a>
                      </li>
                      <li><a href="#"><i class="fab fa-linkedin-in"></i></a>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
              <div
                class="tab-pane fade {{ session('tab') == 'signup' ? 'show active' : '' }}"
                id="pills-signup" role="tabpanel"
                aria-labelledby="pills-profile-tab2">
                <div class="wsus__login">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="wsus__login_input">
                      <i class="fas fa-user-tie"></i>
                      <input id="name" name="name"
                        value="{{ old('name') }}" type="text"
                        placeholder="Name" required autocomplete="name">
                    </div>

                    <div class="wsus__login_input">
                      <i class="far fa-envelope"></i>
                      <input id="email" name="email" type="email"
                        value="{{ old('email') }}" placeholder="Email" required
                        autocomplete="username">
                    </div>

                    <div class="wsus__login_input">
                      <i class="fas fa-key"></i>
                      <input id="password" name="password" type="password"
                        placeholder="Password" required
                        autocomplete="new-password">
                    </div>

                    <div class="wsus__login_input">
                      <i class="fas fa-key"></i>
                      <input id="password_confirmation"
                        name="password_confirmation" type="password"
                        placeholder="Confirm Password" required
                        autocomplete="new-password">
                    </div>

                    <div class="wsus__login_save">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                          id="flexSwitchCheckDefault03">
                        <label class="form-check-label"
                          for="flexSwitchCheckDefault03">I consent
                          to the privacy policy</label>
                      </div>
                    </div>

                    <button class="common_btn" type="submit">signup</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    // Function to update the URL hash without reloading the page
    function updateHash(tab) {
      window.location.hash = tab;
    }

    // Set the active tab based on the hash in the URL
    document.addEventListener('DOMContentLoaded', function() {
      var hash = window.location.hash;
      if (hash) {
        var tab = document.querySelector('button[data-bs-target="' + hash +
          '"]');
        if (tab) {
          tab.click();
        }
      }
    });

    // Update the hash when a tab is clicked
    document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(function(
      tab) {
      tab.addEventListener('click', function() {
        updateHash(tab.getAttribute('data-bs-target'));
      });
    });
  </script>
@endsection
