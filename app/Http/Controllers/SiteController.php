<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        // Retrieves all habits belonging to the authenticated user.
        $habits = auth()->user()->habits;
        $habitLogs = auth()->user()->habitLogs;

        return view('dashboard', compact('habits', 'habitLogs'));
    }
}
