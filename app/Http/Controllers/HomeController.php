<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('status');
    }
}