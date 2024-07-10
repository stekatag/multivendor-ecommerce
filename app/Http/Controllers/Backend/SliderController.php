<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller {
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'subtitle' => ['string', 'max:255'],
            'title' => ['required', 'max:255'],
            'starting_price' => ['max:255'],
            'btn_url' => ['url'],
            'serial' => ['required'],
            'status' => ['required'],
        ]);

        $slider = new Slider();

        // Handle file upload
        $imagePath = $this->uploadImage($request, 'banner', 'uploads/sliders');

        $slider->banner = $imagePath;
        $slider->subtitle = $request->subtitle;
        $slider->title = $request->title;
        $slider->starting_price = $request->starting_price;
        $slider->btn_url = $request->btn_url;
        $slider->serial = $request->serial;
        $slider->status = $request->status;

        $slider->save();

        toastr()->success('Slider created successfully!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
