@props([
    'selectedDate',
    'logsByDay' => collect(),
])

@php
    use Carbon\Carbon;

    /** @var Carbon $selectedDate */
    $selectedDate = $selectedDate instanceof Carbon ? $selectedDate : Carbon::parse($selectedDate);

    $monthStart = $selectedDate->copy()->startOfMonth();
    $monthEnd = $selectedDate->copy()->endOfMonth();

    // Começa no domingo da semana que contém o primeiro dia do mês
    $startGrid = $monthStart->copy()->startOfWeek(Carbon::SUNDAY);
    $endGrid = $monthEnd->copy()->endOfWeek(Carbon::SATURDAY);

    $weeks = [];
    $week = [];

    for ($date = $startGrid->copy(); $date->lte($endGrid); $date->addDay()) {
        $week[] = $date->copy();

        if ($date->dayOfWeek === Carbon::SATURDAY) {
            $weeks[] = $week;
            $week = [];
        }
    }

    $monthName = $selectedDate->locale('pt_BR')->translatedFormat('F Y');
@endphp

<div class="rounded-2xl border border-white/20 bg-white/10 p-3 sm:p-4 backdrop-blur-sm max-w-xs sm:max-w-sm md:max-w-md mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base sm:text-lg font-semibold text-white">
            {{ $monthName }}
        </h2>
        <div class="flex items-center gap-1.5">
            @php
                $prevMonth = $selectedDate->copy()->subMonth()->toDateString();
                $nextMonth = $selectedDate->copy()->addMonth()->toDateString();
            @endphp
            <a
                href="{{ route('habits.index', ['view' => 'calendario', 'date' => $prevMonth]) }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/20 bg-white/5 text-gray-200 hover:bg-white/10 hover:border-cyan-300/60 transition"
                title="Mês anterior"
            >
                ‹
            </a>
            <a
                href="{{ route('habits.index', ['view' => 'calendario', 'date' => now()->toDateString()]) }}"
                class="hidden sm:inline-flex items-center rounded-full border border-cyan-400/40 bg-cyan-500/10 px-3 py-1 text-xs font-medium text-cyan-100 hover:bg-cyan-500/20 hover:border-cyan-300/70 transition"
            >
                Hoje
            </a>
            <a
                href="{{ route('habits.index', ['view' => 'calendario', 'date' => $nextMonth]) }}"
                class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-white/20 bg-white/5 text-gray-200 hover:bg-white/10 hover:border-cyan-300/60 transition"
                title="Próximo mês"
            >
                ›
            </a>
        </div>
    </div>

    {{-- Cabeçalho dos dias da semana --}}
    <div class="grid grid-cols-7 gap-1 text-[11px] font-medium text-gray-300 mb-2">
        @foreach (['D', 'S', 'T', 'Q', 'Q', 'S', 'S'] as $label)
            <div class="flex items-center justify-center py-1">
                {{ $label }}
            </div>
        @endforeach
    </div>

    {{-- Grid de dias --}}
    <div class="grid grid-cols-7 gap-1 text-xs">
        @foreach ($weeks as $week)
            @foreach ($week as $day)
                @php
                    $isCurrentMonth = $day->month === $selectedDate->month;
                    $dateString = $day->toDateString();
                    $hasLogs = isset($logsByDay[$dateString]);
                    $isSelected = $dateString === $selectedDate->toDateString();

                    $baseClasses = 'flex items-center justify-center aspect-square rounded-lg border text-xs transition';

                    if (! $isCurrentMonth) {
                        $classes = $baseClasses . ' border-transparent text-gray-500/60';
                    } else {
                        $classes = $baseClasses . ' border-white/10 text-gray-100 hover:border-cyan-300/60 hover:bg-cyan-500/10';
                    }

                    if ($hasLogs) {
                        $classes .= ' bg-emerald-500/25 border-emerald-400/60';
                    }

                    if ($isSelected) {
                        $classes .= ' ring-2 ring-cyan-300/80 ring-offset-1 ring-offset-slate-900';
                    }
                @endphp

                <a
                    href="{{ route('habits.index', ['view' => 'calendario', 'date' => $dateString]) }}"
                    class="{{ $classes }}"
                    title="{{ $day->format('d/m/Y') }}"
                >
                    {{ $day->day }}
                </a>
            @endforeach
        @endforeach
    </div>
</div>

