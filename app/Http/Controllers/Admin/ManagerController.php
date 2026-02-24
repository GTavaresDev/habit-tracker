<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Usuários com contagem de hábitos e logs
        $users = User::withCount(['habits', 'logs'])->get();

        $totalUsers = $users->count();
        $totalLogs = HabitLog::count();
        $totalHabits = Habit::count();

        // Logs completos para a aba de logs
        $logs = HabitLog::with(['user', 'habit'])
            ->latest('completed_at')
            ->get();

        return view('site.admin.index', compact('totalUsers', 'totalLogs', 'totalHabits', 'users', 'logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * O Route::resource('Admin', ...) cria a rota /Admin/{Admin},
     * então usamos o mesmo nome de parâmetro para o model binding.
     */
    public function edit(User $Admin)
    {
        // Carrega hábitos do usuário com contagem de logs por hábito
        $Admin->load(['habits' => function ($query) {
            $query->withCount('logs');
        }]);

        $user = $Admin;
        return view('site.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $Admin)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $Admin->update($validated);

        return redirect()
            ->route('Admin.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()
            ->route('Admin.index')
            ->with('success', 'Usuário removido com sucesso');
    }
}
