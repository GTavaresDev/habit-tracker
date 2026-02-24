@php
  $currentTab = request()->query('tab', 'usuarios');
@endphp

<aside class="w-72 shrink-0">
  <div class="h-full rounded-3xl border border-white/20 bg-white/10 p-6 sm:p-7 backdrop-blur-xl flex flex-col">
    <div>
      <p class="text-3xl font-semibold text-cyan-200">
        Habit Tracker
        </p>

    </div>

    <nav class="mt-4 space-y-1 text-base flex-1">
      {{-- Usuários --}}
      @php
        $isUsers = $currentTab === 'usuarios';
      @endphp
      <a
        href="{{ route('Admin.index', ['tab' => 'usuarios']) }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 transition
               {{ $isUsers ? 'bg-cyan-500/15 text-cyan-100 border border-cyan-400/40' : 'text-gray-200 border border-transparent hover:bg-white/10 hover:text-white' }}"
      >
        <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-cyan-500/15 text-cyan-200">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m3-2a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
        </span>
        <span class="font-semibold">Usuários</span>
      </a>

      {{-- Logs --}}
      @php
        $isLogs = $currentTab === 'logs';
      @endphp
      <a
        href="{{ route('Admin.index', ['tab' => 'logs']) }}"
        class="flex items-center gap-3 rounded-xl px-4 py-3 transition
               {{ $isLogs ? 'bg-fuchsia-500/15 text-fuchsia-100 border border-fuchsia-400/40' : 'text-gray-200 border border-transparent hover:bg-white/10 hover:text-white' }}"
      >
        <span class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-fuchsia-500/15 text-fuchsia-200">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17l-4-4m0 0l4-4m-4 4h14" />
          </svg>
        </span>
        <span class="font-semibold">Logs</span>
      </a>
    </nav>
  </div>
</aside>

