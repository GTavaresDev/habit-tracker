<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function dashboard()
    {
        // Retrieves all habits belonging to the authenticated user.
        $habits = auth()->user()->habits;
        $habitLogs = auth()->user()->habitLogs;

        return view('site.dashboard', compact('habits', 'habitLogs'));
    }
}
