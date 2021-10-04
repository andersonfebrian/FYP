<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private const PATH = "admin.activity-logs.";

    public function index() {
        return view(self::PATH . 'index');
    }
}
