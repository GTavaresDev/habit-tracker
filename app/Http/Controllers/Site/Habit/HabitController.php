<?php

namespace App\Http\Controllers\Site\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    public function index()
    {
        // Redirect to "hoje" view by default if no view parameter is provided
        if (! request()->has('view')) {
            return redirect()->route('habits.index', ['view' => 'hoje']);
        }

        // Retrieves all habits belonging to the authenticated user.
        $habits = Auth::user()->habits;
        $habitLogs = Auth::user()->habitLogs;

        // Check if viewing "today" view
        $isTodayView = request()->query('view') === 'hoje';
        $todayDateFormatted = $isTodayView ? now()->locale('pt_BR')->translatedFormat('l, d \d\e F \d\e Y') : null;

        return view('site.habit.index', compact('habits', 'habitLogs', 'isTodayView', 'todayDateFormatted'));
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
            ->route('habits.index', ['view' => 'hoje'])
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
            ->route('habits.index', ['view' => 'hoje'])
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
            ->route('habits.index', ['view' => 'hoje'])
            ->with('success', 'Hábito removido com sucesso');
    }
}
