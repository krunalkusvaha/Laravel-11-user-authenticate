<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // This method will show dashboard page for user 
    public function index() {
        return view('user.dashboard');
    }
}
