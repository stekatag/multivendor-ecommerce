@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Vendor Profile</h1>

    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-xl-9 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Vendor Profile</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.vendor-profile.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="banner">Banner Image Preview</label>
                  <img width="200px" src="{{ asset($profile->banner) }}"
                    alt="Banner Image" class="img-thumbnail d-block">
                </div>
                <div class="form-group">
                  <label for="banner">Banner Image</label>
                  <input type="file" class="form-control" data-tribute="true"
                    name="banner" id="banner">
                </div>
                <div class="form-group">
                  <label for="shop_name">Shop Name</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Your shop name" name="shop_name" id="shop_name"
                    value="{{ $profile->shop_name }}">
                </div>
                <div class="form-group">
                  <label for="phone">Phone number</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="089..." name="phone" id="phone"
                    value="{{ $profile->phone }}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" data-tribute="true"
                    placeholder="johndoe@gmail.com" name="email" id="email"
                    value="{{ $profile->email }}">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="19 Vasil Levski str." name="address"
                    id="address" value="{{ $profile->address }}">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="summernote"
                    placeholder="Description...">{{ $profile->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="fb_link">Facebook Link</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="https://www.facebook.com/..." name="fb_link"
                    id="fb_link" value="{{ $profile->fb_link }}">
                </div>
                <div class="form-group">
                  <label for="insta_link">Instagram Link</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="https://www.instagram.com/..." name="insta_link"
                    id="insta_link" value="{{ $profile->insta_link }}">
                </div>
                <div class="form-group">
                  <label for="twitter_link">Twitter Link</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="https://www.twitter.com/..." name="twitter_link"
                    id="twitter_link" value="{{ $profile->twitter_link }}">
                </div>

                <button type="submit" class="btn btn-primary">Update
                  Vendor Profile</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
