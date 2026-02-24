<x-layout>
  <main class="relative min-h-[calc(100vh-110px)] overflow-hidden px-0 py-0">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="w-full h-full">
      <div class="flex gap-6 h-full min-h-[calc(100vh-110px)] px-4 py-6 sm:px-6 sm:py-6 lg:px-8 lg:py-8 items-stretch">
        {{-- Sidebar Admin fixa --}}
        <x-admin.sidebar />

        {{-- Painel principal de edição --}}
        <section class="flex-1 rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
          <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">
            Admin / Editar
          </p>
          <div class="mt-2 flex items-center justify-between gap-4">
            <h1 class="text-3xl font-semibold text-white">
              Editar usuário: {{ $user->name }}
            </h1>
          </div>
          <p class="mt-2 text-sm text-gray-200">
            Esta é a tela de edição para o recurso selecionado. Ajuste aqui o conteúdo conforme o CRUD que desejar implementar.
          </p>

          <div class="mt-6 rounded-2xl border border-white/20 bg-white/5 p-6">
            <p class="text-sm text-gray-200 mb-4">
              Placeholder de formulário — personalize depois com os campos reais.
            </p>
            <form method="POST" action="{{ route('Admin.update', ['Admin' => $user]) }}">
              @csrf
              @method('PUT')
              <div class="grid gap-4 sm:grid-cols-2">
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-xs font-medium text-gray-200 mb-1">
                    Nome
                  </label>
                  <input
                    type="text"
                    name="name"
                    class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/60"
                    placeholder="Digite o nome..."
                    value="{{ old('name', $user->name) }}"
                  />
                </div>
                <div class="col-span-2 sm:col-span-1">
                  <label class="block text-xs font-medium text-gray-200 mb-1">
                    E-mail
                  </label>
                  <input
                    type="email"
                    name="email"
                    class="w-full rounded-xl border border-white/20 bg-white/10 px-3 py-2 text-sm text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/60"
                    placeholder="email@exemplo.com"
                    value="{{ old('email', $user->email) }}"
                  />
                </div>
              </div>

              <div class="mt-6 flex items-center gap-3">
                <button
                  type="submit"
                  class="rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
                >
                  Salvar alterações
                </button>
                <a
                  href="{{ route('Admin.index') }}"
                  class="text-sm text-gray-300 hover:text-white underline underline-offset-4"
                >
                  Voltar para o painel
                </a>
              </div>
            </form>
          </div>

          {{-- Hábitos do usuário --}}
          <div class="mt-8">
            <h2 class="text-lg font-semibold text-white mb-4">
              Hábitos do usuário
            </h2>

            @if ($user->habits->isEmpty())
              <p class="text-sm text-gray-300">
                Este usuário ainda não possui hábitos cadastrados.
              </p>
            @else
              <div class="space-y-3">
                @foreach ($user->habits as $habit)
                  <div class="rounded-xl border border-white/20 bg-white/5 p-4 flex items-center justify-between gap-4">
                    <div>
                      <p class="text-sm font-medium text-white">
                        {{ $habit->name }}
                      </p>
                      <p class="text-xs text-gray-300 mt-0.5">
                        {{ $habit->logs_count ?? 0 }} registros de conclusão
                      </p>
                    </div>
                    <div class="flex items-center gap-2">
                      <a href="{{ route('habits.edit', $habit) }}">
                        <button
                          type="button"
                          class="rounded-lg border border-cyan-400/40 bg-cyan-500/10 px-2.5 py-1 text-xs text-cyan-100 hover:bg-cyan-500/20 transition"
                        >
                          Editar hábito
                        </button>
                      </a>
                      <form
                        action="{{ route('habits.destroy', $habit) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja remover este hábito deste usuário?');"
                      >
                        @csrf
                        @method('DELETE')
                        <button
                          type="submit"
                          class="rounded-lg border border-rose-400/40 bg-rose-500/10 px-2.5 py-1 text-xs text-rose-100 hover:bg-rose-500/20 transition"
                        >
                          Remover hábito
                        </button>
                      </form>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </section>
      </div>
    </div>
  </main>
</x-layout>

