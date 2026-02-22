<header class="border-b border-white/20 bg-white/10 backdrop-blur-xl">
  <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
    {{-- LOGO --}}
    <div>
      <a href="{{ route('habits.index') }}" class="text-xl font-semibold text-white transition hover:text-cyan-200">
        Logo do site
      </a>
    </div>

    {{-- Menu --}}
    <div class="flex items-center gap-3">
      @auth
        <p class="text-sm text-gray-200">
          Bem vindo, <span class="font-medium text-white">{{ auth()->user()->name }}</span>
        </p>
        <form action="{{ route('site.logout') }}" method="POST">
          @csrf
          <button
            type="submit"
            class="rounded-xl border border-white/25 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
          >
            Sair
          </button>
        </form>
      @endauth

      @guest
        <a
          href="{{ route('login') }}"
          class="rounded-xl border border-white/25 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
        >
          Login
        </a>
      @endguest
    </div>
  </div>
</header>