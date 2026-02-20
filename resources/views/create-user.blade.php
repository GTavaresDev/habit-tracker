<x-layout>
  <main class="relative min-h-[calc(100vh-152px)] overflow-hidden px-4 py-10 sm:px-6 lg:px-8">
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute -left-20 top-8 h-56 w-56 rounded-full bg-cyan-500/20 blur-3xl"></div>
      <div class="absolute right-0 top-28 h-64 w-64 rounded-full bg-fuchsia-500/20 blur-3xl"></div>
      <div class="absolute bottom-6 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-indigo-500/20 blur-3xl"></div>
    </div>

    <div class="mx-auto w-full max-w-md">
      <section class="rounded-3xl border border-white/20 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
        <p class="text-sm font-medium uppercase tracking-wider text-cyan-200">Criar conta</p>
        <h1 class="mt-2 text-3xl font-semibold text-white">Cadastre-se agora</h1>
        <p class="mt-2 text-sm text-gray-200">
          Preencha os dados abaixo para criar sua conta.
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

        <form action=" {{ route('site.auth.register') }} " method="POST" class="mt-8 space-y-5">
          @csrf

          <div>
            <label for="name" class="mb-2 block text-sm font-medium text-gray-100">Nome completo</label>
            <input
              id="name"
              name="name"
              type="text"
              value="{{ old('name') }}"
              autocomplete="name"
              required
              class="w-full rounded-xl border {{ $errors->has('name') ? 'border-rose-400/60 bg-rose-400/5' : 'border-white/25 bg-white/10' }} px-4 py-3 text-white outline-none transition placeholder:text-gray-300 focus:border-cyan-300 focus:ring-2 focus:ring-cyan-300/40"
              placeholder="Seu nome completo"
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

          <div>
            <label for="email" class="mb-2 block text-sm font-medium text-gray-100">Email</label>
            <input
              id="email"
              name="email"
              type="email"
              value="{{ old('email') }}"
              autocomplete="email"
              required
              class="w-full rounded-xl border {{ $errors->has('email') ? 'border-rose-400/60 bg-rose-400/5' : 'border-white/25 bg-white/10' }} px-4 py-3 text-white outline-none transition placeholder:text-gray-300 focus:border-cyan-300 focus:ring-2 focus:ring-cyan-300/40"
              placeholder="voce@exemplo.com"
            >
            @error('email')
              <p class="mt-2 flex items-center gap-1.5 text-sm text-rose-200">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
              </p>
            @enderror
          </div>

          <div>
            <label for="password" class="mb-2 block text-sm font-medium text-gray-100">Senha</label>
            <div class="relative">
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border {{ $errors->has('password') ? 'border-rose-400/60 bg-rose-400/5' : 'border-white/25 bg-white/10' }} px-4 py-3 pr-12 text-white outline-none transition placeholder:text-gray-300 focus:border-cyan-300 focus:ring-2 focus:ring-cyan-300/40"
                placeholder="Mínimo 5 caracteres"
              >
              <button
                type="button"
                id="toggle-password"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-sm font-medium text-gray-200 transition hover:text-white"
                aria-label="Mostrar senha"
              >
                Ver
              </button>
            </div>
            @error('password')
              <p class="mt-2 flex items-center gap-1.5 text-sm text-rose-200">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
              </p>
            @enderror
          </div>

          <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-100">Confirmar senha</label>
            <div class="relative">
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                required
                class="w-full rounded-xl border {{ $errors->has('password_confirmation') ? 'border-rose-400/60 bg-rose-400/5' : 'border-white/25 bg-white/10' }} px-4 py-3 pr-12 text-white outline-none transition placeholder:text-gray-300 focus:border-cyan-300 focus:ring-2 focus:ring-cyan-300/40"
                placeholder="Digite a senha novamente"
              >
              <button
                type="button"
                id="toggle-password-confirmation"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-sm font-medium text-gray-200 transition hover:text-white"
                aria-label="Mostrar senha de confirmação"
              >
                Ver
              </button>
            </div>
            @error('password_confirmation')
              <p class="mt-2 flex items-center gap-1.5 text-sm text-rose-200">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
              </p>
            @enderror
          </div>

          <button
            type="submit"
            class="w-full rounded-xl bg-gradient-to-r from-cyan-400 to-indigo-500 px-4 py-3 font-semibold text-slate-900 transition hover:from-cyan-300 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/50"
          >
            Criar conta
          </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-200">
          Ja tem uma conta?
          <a href="{{ route('site.index') }}" class="font-semibold text-cyan-200 transition hover:text-cyan-100">
            Fazer login
          </a>
        </p>
      </section>
    </div>
  </main>

  <script>
    (() => {
      const passwordInput = document.getElementById('password');
      const passwordConfirmationInput = document.getElementById('password_confirmation');
      const togglePasswordButton = document.getElementById('toggle-password');
      const togglePasswordConfirmationButton = document.getElementById('toggle-password-confirmation');

      if (passwordInput && togglePasswordButton) {
        togglePasswordButton.addEventListener('click', () => {
          const isPasswordHidden = passwordInput.type === 'password';
          passwordInput.type = isPasswordHidden ? 'text' : 'password';
          togglePasswordButton.textContent = isPasswordHidden ? 'Ocultar' : 'Ver';
          togglePasswordButton.setAttribute(
            'aria-label',
            isPasswordHidden ? 'Ocultar senha' : 'Mostrar senha'
          );
        });
      }

      if (passwordConfirmationInput && togglePasswordConfirmationButton) {
        togglePasswordConfirmationButton.addEventListener('click', () => {
          const isPasswordHidden = passwordConfirmationInput.type === 'password';
          passwordConfirmationInput.type = isPasswordHidden ? 'text' : 'password';
          togglePasswordConfirmationButton.textContent = isPasswordHidden ? 'Ocultar' : 'Ver';
          togglePasswordConfirmationButton.setAttribute(
            'aria-label',
            isPasswordHidden ? 'Ocultar senha de confirmação' : 'Mostrar senha de confirmação'
          );
        });
      }
    })();
  </script>
</x-layout>
