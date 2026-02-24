<x-layout>
  <main class="relative min-h-[calc(100vh-120px)] overflow-hidden px-4 py-10 sm:px-6 lg:px-8">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="mx-auto w-full max-w-5xl">
      <section class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-10 overflow-visible">
        {{-- Hero --}}
        <div class="grid gap-8 lg:grid-cols-[1.4fr,1fr] items-center">
          <div>
            <p class="text-sm font-medium uppercase tracking-[0.22em] text-cyan-200">
              Habit Tracker
            </p>
            <h1 class="mt-3 text-3xl sm:text-4xl lg:text-5xl font-semibold text-white leading-tight">
              Construa hábitos consistentes,<br class="hidden sm:block" />
              um dia de cada vez.
            </h1>
            <p class="mt-4 text-sm sm:text-base text-gray-200 max-w-xl">
              Este sistema foi criado para te ajudar a criar, acompanhar e manter hábitos saudáveis.
              Veja o que você já fez hoje, visualize o histórico completo do ano e gerencie todos os
              seus hábitos em um painel simples e bonito.
            </p>

            {{-- Exemplos práticos --}}
            <div class="mt-5 space-y-2">
              <p class="text-xs uppercase tracking-[0.22em] text-cyan-200">
                Exemplos do que você pode acompanhar
              </p>
              <div class="flex flex-wrap gap-2">
                <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs text-gray-100">
                  Ler 10 páginas por dia
                </span>
                <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs text-gray-100">
                  Beber 2L de água
                </span>
                <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs text-gray-100">
                  Meditar 5 minutos
                </span>
                <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs text-gray-100">
                  Ir treinar
                </span>
                <span class="rounded-full border border-white/25 bg-white/10 px-3 py-1 text-xs text-gray-100">
                  Estudar programação
                </span>
              </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-3">
              @auth
                <a href="{{ route('habits.index', ['view' => 'hoje']) }}">
                  <button
                    type="button"
                    class="rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
                  >
                    Ir para meu painel
                  </button>
                </a>
              @endauth

              @guest
                <a href="{{ route('login') }}">
                  <button
                    type="button"
                    class="rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
                  >
                    Começar agora
                  </button>
                </a>
                <a href="{{ route('site.create-user') }}" class="text-sm text-gray-200 hover:text-white underline underline-offset-4">
                  Criar uma conta gratuita
                </a>
              @endguest
            </div>

            @auth
              <p class="mt-4 text-sm text-gray-300">
                Bem vindo, <span class="font-medium text-white">{{ auth()->user()->name }}</span>.
                Continue de onde parou acessando o painel de hábitos.
              </p>
            @endauth
          </div>

          {{-- Destaques --}}
          <div class="space-y-4">
            <div class="rounded-2xl border border-white/25 bg-white/10 p-4">
              <h2 class="text-sm font-semibold text-white">
                Visão diária inteligente
              </h2>
              <p class="mt-1.5 text-xs text-gray-200">
                Veja rapidamente quais hábitos você já cumpriu hoje e quais ainda precisa fazer,
                com um botão de marcação simples e rápido.
              </p>
            </div>
            <div class="rounded-2xl border border-white/25 bg-white/10 p-4">
              <h2 class="text-sm font-semibold text-white">
                Histórico completo do ano
              </h2>
              <p class="mt-1.5 text-xs text-gray-200">
                Acompanhe em um gráfico visual todos os dias em que você cumpriu cada hábito,
                identificando facilmente sua consistência ao longo do tempo.
              </p>
            </div>
            <div class="rounded-2xl border border-white/25 bg-white/10 p-4">
              <h2 class="text-sm font-semibold text-white">
                Painel administrativo
              </h2>
              <p class="mt-1.5 text-xs text-gray-200">
                Para administradores, há um painel dedicado para visualizar usuários,
                seus hábitos e todos os logs do sistema, com opções de edição e remoção.
              </p>
            </div>

            {{-- Como funciona --}}
            <div class="mt-2 rounded-2xl border border-white/25 bg-white/10 p-4">
              <h2 class="text-sm font-semibold text-white">
                Como funciona na prática
              </h2>
              <ol class="mt-2 space-y-1.5 text-xs text-gray-200 list-decimal list-inside">
                <li>Cadastre 2–3 hábitos simples que você quer construir.</li>
                <li>Todos os dias, acesse o painel e marque o que foi concluído.</li>
                <li>Acompanhe no histórico e no calendário os dias em que você conseguiu manter o ritmo.</li>
                <li>Use o painel de administração (se tiver acesso) para ver o uso geral do sistema.</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</x-layout>
