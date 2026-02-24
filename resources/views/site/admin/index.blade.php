<x-layout>
  <main class="relative min-h-[calc(100vh-110px)] overflow-hidden px-0 py-0">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="w-full h-full">
      <div class="flex gap-6 h-full min-h-[calc(100vh-110px)] px-4 py-6 sm:px-6 sm:py-6 lg:px-8 lg:py-8 items-stretch">
        {{-- Sidebar Admin fixa - ocupa toda altura --}}
        <x-admin.sidebar />

        {{-- Painel principal - ocupa o restante --}}
        <section class="flex-1 rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8 overflow-y-auto">
          <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">Painel Administrativo</p>
          <div class="mt-2 flex items-center justify-between gap-4">
            <h1 class="text-3xl font-semibold text-white">Gerenciador</h1>
          </div>
          <p class="mt-2 text-sm text-gray-200">
            Gerencie usuários e monitore estatísticas do sistema.
          </p>

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

          @php
            $currentTab = request()->query('tab', 'usuarios');
          @endphp

          {{-- Cards de Estatísticas (sempre visíveis) --}}
          <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
              <div class="flex items-center gap-3">
                <div class="rounded-lg border border-cyan-400/40 bg-cyan-500/10 p-2">
                  <svg class="h-6 w-6 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-300">Total de Usuários</p>
                  <p class="text-xl font-semibold text-white">{{ $totalUsers ?? 0 }}</p>
                </div>
              </div>
            </div>

            <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
              <div class="flex items-center gap-3">
                <div class="rounded-lg border border-fuchsia-400/40 bg-fuchsia-500/10 p-2">
                  <svg class="h-6 w-6 text-fuchsia-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-300">Total de Logs</p>
                  <p class="text-xl font-semibold text-white">{{ $totalLogs ?? 0 }}</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Painéis por aba --}}
          @if ($currentTab === 'usuarios')
            {{-- Lista de Usuários --}}
            <div class="mt-6">
              <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-white">Usuários do Sistema</h2>
                <button
                  type="button"
                  class="rounded-xl border border-cyan-400/40 bg-cyan-500/10 px-3 py-1.5 text-xs font-medium text-cyan-100 hover:bg-cyan-500/20 hover:border-cyan-300/70 transition"
                >
                  Novo usuário (UI)
                </button>
              </div>
              <div class="space-y-3">
                @forelse ($users ?? [] as $user)
                  <div class="rounded-xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm transition hover:bg-white/15">
                    <div class="flex items-center justify-between gap-4">
                      <div class="flex items-center gap-4 flex-1">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border border-cyan-400/40 bg-cyan-500/10 text-cyan-200 font-semibold">
                          {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                          <p class="text-white font-medium">{{ $user->name }}</p>
                          <p class="text-xs text-gray-300">{{ $user->email }}</p>
                        </div>
                      </div>
                      <div class="flex items-center gap-3 text-xs sm:text-sm">
                        <div class="flex items-center gap-1.5 text-gray-200">
                          <svg class="h-4 w-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                          </svg>
                          <span>{{ $user->habits_count ?? 0 }} hábitos</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-gray-200">
                          <svg class="h-4 w-4 text-fuchsia-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          <span>{{ $user->logs_count ?? 0 }} logs</span>
                        </div>
                        <div class="flex items-center gap-2">
                          <a href="{{ route('Admin.edit', $user) }}">
                            <button
                              type="button"
                              class="rounded-lg border border-white/30 bg-white/5 px-2.5 py-1 text-xs text-gray-100 hover:bg-white/15 transition"
                            >
                              Editar
                            </button>
                          </a>
                          <form
                            action="{{ route('Admin.destroy', ['Admin' => $user]) }}"
                            method="POST"
                            onsubmit="return confirm('Tem certeza que deseja remover este usuário?');"
                          >
                            @csrf
                            @method('DELETE')
                            <button
                              type="submit"
                              class="rounded-lg border border-rose-400/40 bg-rose-500/10 px-2.5 py-1 text-xs text-rose-100 hover:bg-rose-500/20 transition"
                            >
                              Remover
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @empty
                  <div class="rounded-xl border border-white/20 bg-white/10 p-6 backdrop-blur-sm text-center">
                    <p class="text-gray-300">Nenhum usuário cadastrado ainda.</p>
                  </div>
                @endforelse
              </div>
            </div>
          @elseif ($currentTab === 'logs')
            {{-- Lista de Logs --}}
            <div class="mt-6">
              <h2 class="mb-4 text-lg font-semibold text-white">Logs de Atividades</h2>
              <div class="overflow-x-auto rounded-2xl border border-white/20 bg-white/5">
                <table class="min-w-full text-left text-sm text-gray-100">
                  <thead class="bg-white/5 text-xs uppercase tracking-wide text-gray-300">
                    <tr>
                      <th class="px-4 py-3">Data</th>
                      <th class="px-4 py-3">Usuário</th>
                      <th class="px-4 py-3">Hábito</th>
                      <th class="px-4 py-3 text-right">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($logs as $log)
                      <tr class="border-t border-white/10 hover:bg-white/5">
                        <td class="px-4 py-3 text-xs">
                          {{ \Carbon\Carbon::parse($log->completed_at)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                          {{ $log->user->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                          {{ $log->habit->name ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-right text-xs">
                          <button
                            type="button"
                            class="rounded-lg border border-rose-400/40 bg-rose-500/10 px-2.5 py-1 text-rose-100 hover:bg-rose-500/20 transition"
                          >
                            Remover log
                          </button>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-300">
                          Nenhum log registrado ainda.
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          @endif
        </section>
      </div>
    </div>
  </main>
</x-layout>

