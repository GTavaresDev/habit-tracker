<x-layout>
  <main class="relative min-h-[calc(100vh-152px)] overflow-hidden px-4 py-10 sm:px-6 lg:px-8">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="mx-auto w-full max-w-4xl">
      <section class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
        <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">Meus hábitos</p>
        <div class="mt-2 flex items-center justify-between gap-4">
          <h1 class="text-3xl font-semibold text-white">Dashboard</h1>
          <a href=" {{ route('site.create-habit') }}">
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

        <div class="mt-6 space-y-3">
          @forelse ($habits as $item)
            <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm transition hover:bg-white/15">
              <div class="flex items-center justify-between">
                <p class="text-white font-medium">{{ $item->name }}</p>
                <span class="text-sm text-gray-300">{{ $item->logs?->count() ?? 0 }} vezes</span>
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
