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
                href="#"
                class="whitespace-nowrap rounded-xl border border-cyan-400/40 bg-cyan-500/10 px-4 py-2.5 text-sm font-medium text-cyan-200 transition-all duration-200 hover:bg-cyan-500/20 hover:text-cyan-100 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 shadow-sm hover:shadow-md"
              >
                Hoje
              </a>
              <a
                href="#"
                class="whitespace-nowrap rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition-all duration-200 hover:bg-white/15 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-300/50 shadow-sm hover:shadow-md"
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
                href="#"
                class="whitespace-nowrap rounded-xl border border-white/25 bg-white/10 px-4 py-2.5 text-sm font-medium text-white transition-all duration-200 hover:bg-white/15 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-cyan-300/50 shadow-sm hover:shadow-md"
              >
                Gerenciar Hábitos
              </a>
            </div>
          </nav>
        </div>

        @if (session('success'))
          <div class="mt-6 rounded-xl border border-emerald-300/40 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-100">
            <div class="flex items-center gap-2">
              <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a1 1 0 00-1.214-1.214L9 9.586 7.357 7.943a1 1 0 00-1.214 1.214l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>{{ session('success') }}</span>
            </div>
          </div>
        @endif

        <div class="mt-6 space-y-3">
          @forelse ($habits as $item)
            <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm transition hover:bg-white/15">
              <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4 flex-1">
                  <p class="text-white font-medium">{{ $item->name }}</p>
                  <span class="text-sm text-gray-300">{{ $item->logs?->count() ?? 0 }} vezes</span>
                </div>
                <div class="flex items-center gap-2">
                  <a href="{{ route('habits.edit', $item) }}">
                    <button
                      type="button"
                      class="rounded-lg border border-cyan-400/40 bg-cyan-500/10 px-3 py-1.5 text-sm font-medium text-cyan-200 transition hover:bg-cyan-500/20 hover:text-cyan-100 focus:outline-none focus:ring-2 focus:ring-cyan-400/50"
                    >
                      Editar
                    </button>
                  </a>
                  <form action="{{ route('habits.destroy', $item) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      onclick="return confirm('Tem certeza que deseja remover este hábito?')"
                      class="rounded-lg border border-rose-400/40 bg-rose-500/10 px-3 py-1.5 text-sm font-medium text-rose-200 transition hover:bg-rose-500/20 hover:text-rose-100 focus:outline-none focus:ring-2 focus:ring-rose-400/50"
                    >
                      Remover
                    </button>
                  </form>
                </div>
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
