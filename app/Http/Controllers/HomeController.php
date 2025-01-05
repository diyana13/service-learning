<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lecturerIndex()
    {
        return view('lecturer.home');
    }

    public function studentIndex()
    {
        return view('student.home');
    }

    public function assessorIndex()
    {
        return view('assessor.home');
    }
}
