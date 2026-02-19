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

  <body>
    <h1 class="text-3xl font-bold underline">
      {{ config('app.name') }}
    </h1>
 
</html>