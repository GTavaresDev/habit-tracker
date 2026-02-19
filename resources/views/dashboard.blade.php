<x-layout>
  <main class="py-10">
  <h1 class="text-white">
    Painel Dashbaord
  </h1>

  @auth
    <p class="text-white">
      Bem vindo, {{ auth()->user()->name }}
    </p>
  @endauth
</x-layout>