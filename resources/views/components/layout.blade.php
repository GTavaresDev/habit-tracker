<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      {{ config('app.name') }}
    </title>

    @vite('resources/css/app.css')
  </head>

  <body class="bg-gray-800">
    {{-- Header --}}
    <x-header />

    {{-- Content --}}
    {{ $slot }}

    {{-- Footer --}}
    <x-footer />
  </body>
</html>