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

    public function store(HabitRequest $request)
    {
        Habit::create([
            'user_id' => auth()->id(),
            'name' => $request->validated()['name'],
        ]);

        return redirect()
            ->route('site.dashboard')
            ->with('success', 'Hábito cadastrado com sucesso!');
    }

    public function destroy(Habit $habit)
    {
        // Validate if user_id is == habit_id
        if ($habit->user_id != auth()->id()) {
            abort(code: 403, message: 'Ação bloqueada');
        }

        $habit->delete();

        return redirect()
            ->route('site.dashboard')
            ->with('success', 'Hábito removido com sucesso');
    }
}
