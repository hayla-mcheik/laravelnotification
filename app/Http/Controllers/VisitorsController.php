<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    public function index()
    {
        $count = DB::table('visitors')->count();

        return view('admin.dashboard', compact('count'));
    }
}
