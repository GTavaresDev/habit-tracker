<?php

namespace App\Http\Controllers\Site\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\HabitRequest;
use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HabitController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Redirect to "hoje" view by default if no view parameter is provided
        if (! request()->has('view')) {
            return redirect()->route('habits.index', ['view' => 'hoje']);
        }

        // Retrieves all habits belonging to the authenticated user with logs eager loaded.
        $habits = Auth::user()->habits()
            ->with('logs')
            ->get();

        // Check current screen mode
        $view = request()->query('view');
        $isTodayView = $view === 'hoje';
        $isManageView = $view === 'gerenciar';
        $isHistoryView = $view === 'historico';
        $isCalendarView = $view === 'calendario';

        $todayDateFormatted = $isTodayView
            ? now()->locale('pt_BR')->translatedFormat('l, d \d\e F \d\e Y')
            : null;

        // Get today's completed habit IDs using already loaded logs (no additional query)
        $todayCompletedHabitIds = [];
        if ($isTodayView) {
            $today = Carbon::today()->toDateString();
            foreach ($habits as $habit) {
                $hasLogToday = $habit->logs->contains(function ($log) use ($today) {
                    $logDate = is_string($log->completed_at) ? $log->completed_at : $log->completed_at->toDateString();
                    return $logDate === $today;
                });
                if ($hasLogToday) {
                    $todayCompletedHabitIds[] = $habit->id;
                }
            }
        }

        // Dados específicos da tela de calendário
        $selectedDate = null;
        $completedHabitsOnSelectedDate = collect();
        $logsByDay = collect();

        if ($isCalendarView) {
            // Data selecionada (padrão: hoje)
            $selectedDateInput = request()->query('date');
            try {
                $selectedDate = $selectedDateInput
                    ? Carbon::parse($selectedDateInput)
                    : Carbon::today();
            } catch (\Exception $e) {
                $selectedDate = Carbon::today();
            }

            $selectedDateString = $selectedDate->toDateString();

            // Agrupa todos os logs por dia (para pintar o calendário)
            $allLogs = $habits->flatMap(function ($habit) {
                return $habit->logs;
            });

            $logsByDay = $allLogs->groupBy(function ($log) {
                $date = $log->completed_at;
                return is_string($date)
                    ? $date
                    : $date->toDateString();
            })->map->count();

            // Hábitos concluídos na data selecionada
            $completedHabitsOnSelectedDate = $habits->filter(function ($habit) use ($selectedDateString) {
                return $habit->logs->contains(function ($log) use ($selectedDateString) {
                    $logDate = is_string($log->completed_at) ? $log->completed_at : $log->completed_at->toDateString();
                    return $logDate === $selectedDateString;
                });
            });
        }

        return view('site.habit.index', compact(
            'habits',
            'isTodayView',
            'isManageView',
            'isHistoryView',
            'isCalendarView',
            'todayDateFormatted',
            'todayCompletedHabitIds',
            'selectedDate',
            'completedHabitsOnSelectedDate',
            'logsByDay'
        ));
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
        // if ($habit->user_id != auth()->id()) {
        //     abort(code: 403, message: 'Ação bloqueada');
        // }

        $this->authorize('update', $habit);

        return view('site.habit.edit', compact('habit'));
    }

    public function update(HabitRequest $request, Habit $habit)
    {
        // Check if the authenticated user is the owner of the habit.
        // if ($habit->user_id != auth()->id()) {
        //     abort(code: 403, message: 'Ação bloqueada');
        // }

        $this->authorize('update', $habit);

        $habit->update($request->all());

        return redirect()
            ->route('habits.index', ['view' => 'hoje'])
            ->with('success', 'Hábito atualizado com sucesso!');
    }

    public function destroy(Habit $habit)
    {
        // Check if the authenticated user is the owner of the habit.
        // if ($habit->user_id != auth()->id()) {
        //     abort(code: 403, message: 'Ação bloqueada');
        // }

        $this->authorize('delete', $habit);

        $habit->delete();

        return redirect()
            ->route('habits.index', ['view' => 'hoje'])
            ->with('success', 'Hábito removido com sucesso');
    }

    public function toggle(Habit $habit)
    {
        //1. Verificar se o usuario logado é o dono do habito
        // Check if the authenticated user is the owner of the habit.
        if ($habit->user_id != auth()->id()) {
            abort(code: 403, message: 'Ação bloqueada');
        }

        //2. Pegar a data de hoje
        $today = Carbon::today()->toDateString();

        //2.1 Pegar o log
        $log = HabitLog::query()
            ->where('habit_id', $habit->id)
            ->where('completed_at', $today)
            ->first();

        //3. Validar se nessa data já existe um registro
        if($log){
            //4. Se exitir remover o registro
            $log->delete();
            $message = 'Hábito desmarcado.';
        } else {
            //5. Se não, criar novo registro
            HabitLog::create([
                'user_id' => auth()->id(),
                'habit_id'=> $habit->id,
                'completed_at' => $today,
            ]);
            $message = 'Hábito concluido.';
        }


        //6. Retornar para página anterior
        return redirect()
            ->route('habits.index', ['view' => 'hoje'])
            ->with('success', $message);
    }
}
