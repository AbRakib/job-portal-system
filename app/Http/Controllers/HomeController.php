<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
    public function index() {
        return view('front.home');
    }

    public function contact() {
        return view('front.contact');
    }
}
