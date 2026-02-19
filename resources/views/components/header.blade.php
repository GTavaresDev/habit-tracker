<header class="bg-white border-b-2 flex items-center justify-between p-4">
 {{-- LOGO --}}
  <div>
    Logo do site
  </div>

  {{-- GitHub --}}
  <div class="flex items-center gap-2">
    github

    @auth
      <form action="{{ route('site.logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-white p-2 border-2">
          Sair
        </button>
      </form>
    @endauth

    @guest
      <a href="{{ route('site.index') }}" class="bg-white p-2 border-2">
        Login
      </a>
    @endguest
  </div>
</header>