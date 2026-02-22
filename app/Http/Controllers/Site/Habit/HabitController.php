<?php

namespace App\Http\Controllers\Site\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\HabitRequest;
use App\Models\Habit;

class HabitController extends Controller
{
    public function index()
    {
        // Retrieves all habits belonging to the authenticated user.
        $habits = auth()->user()->habits;
        $habitLogs = auth()->user()->habitLogs;

        return view('site.habit.index', compact('habits', 'habitLogs'));
    }

    public function create()
    {
        return view('site.habit.create');
    }

    public function store(HabitRequest $request)
    {
        Habit::create([
            'user_id' => auth()->id(),
            'name' => $request->validated()['name'],
        ]);

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito cadastrado com sucesso!');
    }

    public function edit(Habit $habit)
    {
        // Check if the authenticated user is the owner of the habit.
        if ($habit->user_id != auth()->id()) {
            abort(code: 403, message: 'Ação bloqueada');
        }

        return view('site.habit.edit', compact('habit'));
    }

    public function update(HabitRequest $request, Habit $habit)
    {
        // Check if the authenticated user is the owner of the habit.
        if ($habit->user_id != auth()->id()) {
            abort(code: 403, message: 'Ação bloqueada');
        }

        $habit->update($request->all());

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(Habit $habit)
    {
        // Check if the authenticated user is the owner of the habit.
        if ($habit->user_id != auth()->id()) {
            abort(code: 403, message: 'Ação bloqueada');
        }

        $habit->delete();

        return redirect()
            ->route('habits.index')
            ->with('success', 'Hábito removido com sucesso');
    }
}
