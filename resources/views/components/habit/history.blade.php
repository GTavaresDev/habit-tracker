@props(['habit', 'year' => null])

@php
  use Carbon\Carbon;

  // Define o ano (padrão: ano atual)
  $selectedYear = $year ?? now()->year;

  // Primeiro e último dia do ano (padrão)
  $startDate = Carbon::create($selectedYear, 1, 1); // 01/01/YYYY
  $endDate = Carbon::create($selectedYear, 12, 31); // 31/12/YYYY

  // Todas as datas de conclusão deste hábito no ano selecionado
  $logDatesThisYear = $habit->logs
      ->map(function ($log) {
          return Carbon::parse($log->completed_at);
      })
      ->filter(function ($date) use ($selectedYear) {
          return $date->year === $selectedYear;
      });

  // Mapa de datas concluídas (para pintar o grid)
  $completedDates = $logDatesThisYear
      ->map(function ($date) {
          return $date->toDateString();
      })
      ->unique()
      ->flip();

  // Ajusta o início do gráfico para a primeira vez que o cliente marcou o hábito como feito
  $firstLogDate = $logDatesThisYear->sort()->first();
  if ($firstLogDate) {
      $startDate = $firstLogDate->copy();
  }

  $weeks = [];
  $currentWeek = [];

  // Preenche dias vazios no início (se o ano não começar no domingo)
  $firstDayOfWeek = $startDate->dayOfWeek; // 0 = domingo, 1 = segunda, etc
  for ($i = 0; $i < $firstDayOfWeek; $i++) {
    $currentWeek[] = null; // Placeholder vazio
  }

  // Agrupa os dias em semanas (domingo a sábado)
  for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
    $currentWeek[] = $date->copy();

    // Fecha a semana no sábado ou no último dia
    if ($date->isSaturday() || $date->eq($endDate)) {
      $weeks[] = $currentWeek;
      $currentWeek = [];
    }
  }
@endphp

<div class="mb-4 rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
  {{-- NOME + ANO --}}
  <div class="flex items-center justify-between mb-3">
    <h2 class="font-bold text-sm text-white truncate pr-4">
      {{ $habit->name }}
    </h2>
    <span class="text-xs text-cyan-200 font-semibold shrink-0">
      {{ $selectedYear }}
    </span>
  </div>

  {{-- GRID --}}
  <div class="bg-slate-900/40 border border-white/10 p-3 rounded-lg shadow-sm overflow-x-auto scrollbar-hide">
    <div class="flex gap-1 w-max">
      @foreach($weeks as $week)
        <div class="flex flex-col gap-1">
          @foreach($week as $day)
            @if($day === null)
              {{-- Espaço vazio para alinhar semanas --}}
              <div class="w-3 h-3"></div>
            @else
              @php
                $done = isset($completedDates[$day->toDateString()]);
              @endphp
              <div
                class="w-3 h-3 rounded-xs cursor-default transition hover:ring-2 hover:ring-cyan-400/80
                       {{ $done ? 'bg-emerald-400' : 'bg-white/10' }}"
                title="{{ $day->format('d/m/Y') }} - {{ $day->locale('pt_BR')->translatedFormat('l') }}"
              ></div>
            @endif
          @endforeach
        </div>
      @endforeach
    </div>
  </div>

  {{-- LEGENDA --}}
  <div class="flex items-center gap-4 mt-3 text-xs text-gray-200">
    <div class="flex items-center gap-1.5">
      <div class="w-3 h-3 bg-white/10 rounded-xs border border-white/20"></div>
      <span>Não feito</span>
    </div>
    <div class="flex items-center gap-1.5">
      <div class="w-3 h-3 bg-emerald-400 rounded-xs"></div>
      <span>Feito</span>
    </div>
  </div>
</div>

