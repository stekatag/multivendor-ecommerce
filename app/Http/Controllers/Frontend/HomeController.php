<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index() {
        // Get all active sliders, ordered by the serial column
        $sliders = Slider::where('status', 1)->orderBy('serial', 'ASC')->get();

        return view('frontend.home.home', compact('sliders'));
    }
}
