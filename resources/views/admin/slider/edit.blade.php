@extends('admin.layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Slider</h1>

    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-xl-9 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Edit Slider</h4>

            </div>
            <div class="card-body">
              <form action="{{ route('admin.slider.update', $slider->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label>Banner Image Preview</label>
                  <img class="d-block" width="200"
                    src="{{ asset($slider->banner) }}" alt="banner"
                    class="img-thumbnail">
                </div>
                <div class="form-group">
                  <label for="banner">Banner Image</label>
                  <input type="file" class="form-control" data-tribute="true"
                    name="banner" id="banner">
                </div>
                <div class="form-group">
                  <label for="subtitle">Subtitle</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="New arrivals... Hot deals" name="subtitle"
                    id="subtitle" value="{{ $slider->subtitle }}">
                </div>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="Men's Fashion" name="title" id="title"
                    value="{{ $slider->title }}">
                </div>
                <div class="form-group">
                  <label for="starting_price">Starting price</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="29.99" name="starting_price" id="starting_price"
                    value="{{ $slider->starting_price }}">
                </div>
                <div class="form-group">
                  <label for="btn_url">Button URL</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="url" name="btn_url" id="btn_url"
                    value="{{ $slider->btn_url }}">
                </div>
                <div class="form-group">
                  <label for="serial">Serial</label>
                  <input type="text" class="form-control" data-tribute="true"
                    placeholder="1..2" name="serial" id="serial"
                    value="{{ $slider->serial }}">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option {{ $slider->status == 1 ? 'selected' : '' }}
                      value="1" selected>Active</option>
                    <option {{ $slider->status == 0 ? 'selected' : '' }}
                      value="0">Inactive</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Save
                  Changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
