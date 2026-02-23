<x-layout>
  <main class="relative min-h-[calc(100vh-152px)] overflow-hidden px-4 py-10 sm:px-6 lg:px-8">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="mx-auto w-full max-w-4xl">
      <section class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8 overflow-visible">
        <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">Meus hábitos</p>
        <div class="mt-2 flex items-center justify-between gap-4">
          <h1 class="text-3xl font-semibold text-white">Dashboard</h1>
          <a href="{{ route('habits.create') }}">
            <button
                type="button"
                class="rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
            >
                Cadastrar novo hábito
            </button>
          </a>
        </div>
        <p class="mt-2 text-sm text-gray-200">
          Gerencie seus hábitos e acompanhe seu progresso.
        </p>

        {{-- Nav Bar --}}
        <div class="mt-6 -mx-2 sm:-mx-4 py-4 overflow-visible">
          <nav class="overflow-x-auto overflow-y-visible scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
            <div class="flex gap-2 px-2 sm:px-4 py-1 min-w-max">
              <a
                href="{{ route('habits.index', ['view' => 'hoje']) }}"
                class="whitespace-nowrap rounded-xl border {{ request()->query('view') === 'hoje' ? 'border-cyan-400/40 bg-cyan-500/10 text-cyan-200' : 'border-white/25 bg-white/10 text-white' }} px-4 py-2.5 text-sm font-medium transition-all duration-200 hover:bg-cyan-500/20 hover:text-cyan-100 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 shadow-sm hover:shadow-md"
              >
                Hoje
              </a>
              <a
                href="{{ route('habits.index', ['view' => 'historico']) }}"
                class="whitespace-nowrap rounded-xl border {{ $isHistoryView ?? false ? 'border-cyan-400/40 bg-cyan-500/10 text-cyan-200' : 'border-white/25 bg-white/10 text-white' }} px-4 py-2.5 text-sm font-medium transition-all duration-200 hover:bg-cyan-500/20 hover:text-cyan-100 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 shadow-sm hover:shadow-md"
              >
                Histórico
              </a>
              <a
                href="#"
                class="whitespace-nowrap rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition-all duration-200 hover:bg-white/15 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-300/50 shadow-sm hover:shadow-md"
              >
                Calendário
              </a>
              <a
                href="{{ route('habits.index', ['view' => 'gerenciar']) }}"
                class="whitespace-nowrap rounded-xl border {{ $isManageView ?? false ? 'border-cyan-400/40 bg-cyan-500/10 text-cyan-200' : 'border-white/25 bg-white/10 text-white' }} px-4 py-2.5 text-sm font-medium transition-all duration-200 hover:bg-cyan-500/20 hover:text-cyan-100 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 shadow-sm hover:shadow-md"
              >
                Gerenciar Hábitos
              </a>
            </div>
          </nav>
        </div>

        @if (session('success') || session('sucess'))
          <div class="mt-6 rounded-xl border border-emerald-300/40 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
            <div class="flex items-center gap-2">
              <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a1 1 0 00-1.214-1.214L9 9.586 7.357 7.943a1 1 0 00-1.214 1.214l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>{{ session('success') ?? session('sucess') }}</span>
            </div>
          </div>
        @endif

        @if ($isTodayView ?? false)
          <div class="mt-6 rounded-xl border border-cyan-300/40 bg-cyan-400/10 px-4 py-3">
            <div class="flex items-center gap-2">
              <svg class="h-5 w-5 flex-shrink-0 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              <p class="text-sm font-medium text-cyan-100">
                {{ $todayDateFormatted }}
              </p>
            </div>
          </div>
        @endif

        <div class="mt-6 space-y-3">
          @forelse ($habits as $item)
            <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm transition hover:bg-white/15">
              <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                  @php
                    $isCompletedToday = in_array($item->id, $todayCompletedHabitIds ?? []);
                  @endphp
                  @if ($isTodayView ?? false)
                    <form action="{{ route('habits.toggle', $item) }}" method="POST" class="inline">
                      @csrf
                      <button
                        type="submit"
                        class="rounded-lg border {{ $isCompletedToday ? 'border-emerald-400/60 bg-emerald-500/20 text-emerald-100' : 'border-white/25 bg-white/10 text-white' }} px-3 py-1.5 transition-all duration-200 {{ $isCompletedToday ? 'hover:bg-emerald-500/30' : 'hover:bg-white/15 hover:border-white/40' }} hover:scale-110 focus:outline-none focus:ring-2 focus:ring-emerald-400/50"
                        title="{{ $isCompletedToday ? 'Desmarcar hábito' : 'Marcar como feito' }}"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                      </button>
                    </form>
                  @endif
                  <p class="text-white font-medium">{{ $item->name }}</p>
                  @if ($isHistoryView ?? false)
                    <span class="text-sm text-gray-300">{{ $item->logs?->count() ?? 0 }} vezes</span>
                  @endif
                </div>
                @if ($isManageView ?? false)
                  <div class="flex items-center gap-2">
                    <a href="{{ route('habits.edit', $item) }}">
                      <button
                        type="button"
                        class="rounded-lg border border-cyan-400/40 bg-cyan-500/10 px-3 py-1.5 text-cyan-200 transition hover:bg-cyan-500/20 hover:text-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-400/50"
                        title="Editar"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                      </button>
                    </a>
                    <form action="{{ route('habits.destroy', $item) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button
                        type="submit"
                        onclick="return confirm('Tem certeza que deseja remover este hábito?')"
                        class="rounded-lg border border-rose-400/40 bg-rose-500/10 px-3 py-1.5 text-rose-200 transition hover:bg-rose-500/20 hover:text-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-400/50"
                        title="Remover"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                      </button>
                    </form>
                  </div>
                @endif
              </div>
            </div>
          @empty
            <div class="rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-sm text-center">
              <p class="text-gray-300">Nenhum hábito cadastrado ainda.</p>
            </div>
          @endforelse
        </div>
      </section>
    </div>
  </main>
</x-layout>
