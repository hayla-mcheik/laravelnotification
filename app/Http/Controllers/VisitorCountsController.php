<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class VisitorCountsController extends Controller
{
    public function index()
    {
        $count = DB::table('visitor_counts')->value('count');

        return view('admin.dashboard', compact('count'));
    }
}
