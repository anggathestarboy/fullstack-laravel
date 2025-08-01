<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    //Copyright follow dulu
    public function index () {
    return view('pages.admin.dashboard');
}
}
