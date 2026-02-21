<x-layout>
  <main class="relative min-h-[calc(100vh-152px)] overflow-hidden px-4 py-10 sm:px-6 lg:px-8">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="mx-auto w-full max-w-md">
      <section class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
        <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">Novo hábito</p>
        <h1 class="mt-2 text-3xl font-semibold text-white">Cadastrar hábito</h1>
        <p class="mt-2 text-sm text-gray-200">
          Adicione um novo hábito para acompanhar.
        </p>

        @if ($errors->any())
          <div class="mt-6 rounded-xl border border-rose-300/40 bg-rose-400/10 px-4 py-3 text-sm text-rose-100">
            <ul class="space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action=" {{ route('site.create-habit') }}" method="POST" class="mt-8 space-y-5">
          @csrf

          <div>
            <label for="name" class="mb-2 block text-sm font-medium text-gray-100">Nome do hábito</label>
            <input
              id="name"
              name="name"
              type="text"
              value="{{ old('name') }}"
              autocomplete="off"
              required
              class="w-full rounded-xl border {{ $errors->has('name') ? 'border-rose-400/60 bg-rose-400/5' : 'border-white/25 bg-white/10' }} px-4 py-3 text-white outline-none transition placeholder:text-gray-300 focus:border-cyan-300 focus:ring-2 focus:ring-cyan-300/40"
              placeholder="Ex: Exercitar-se, Ler, Meditar..."
            >
            @error('name')
              <p class="mt-2 flex items-center gap-1.5 text-sm text-rose-200">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
              </p>
            @enderror
          </div>

          <div class="flex gap-3">
            <a
              href="{{ route('site.dashboard') }}"
              class="flex-1 rounded-xl border border-white/25 bg-white/10 px-4 py-3 text-center font-semibold text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
            >
              Cancelar
            </a>
            <button
              type="submit"
              class="flex-1 rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-4 py-3 font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
            >
              Cadastrar
            </button>
          </div>
        </form>
      </section>
    </div>
  </main>
</x-layout>
