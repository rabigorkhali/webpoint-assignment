<?php

namespace App\Http\Controllers;

use App\Http\Controllers\System\ResourceController;
use Illuminate\Http\Request;

class HomeController extends ResourceController
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

    public function index(Request $request)
    {
        return view('home');
    }

}
