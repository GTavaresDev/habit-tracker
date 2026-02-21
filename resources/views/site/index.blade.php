<x-layout>
  <main class="py-10">
  <h1>
    Ola Mundo - Site Controller
  </h1>

  @auth
    <p>
      Bem vindo, {{ auth()->user()->name }}
    </p>
  @endauth
</x-layout>
