<?php

namespace App\Http\Controllers;

use App\Http\Requests\HabitRequest;
use App\Models\Habit;

class HabitController extends Controller
{
    public function index()
    {
        return view('create-habit');
    }

    public function create(HabitRequest $habit)
    {
        $habit = Habit::query()->create([
            'user_id' => auth()->user()->id,
            'name' => $habit->input('name'),
        ]);

        $habits = auth()->user()->habits;
        $habitLogs = auth()->user()->habitLogs;

        return view('dashboard', compact('habits', 'habitLogs')); 
    }
}
