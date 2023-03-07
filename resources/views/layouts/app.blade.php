<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')

</head>

<body class="antialiased">
    <div class="relative isolate mx-auto min-h-screen justify-center overflow-hidden bg-gray-800 sm:py-10">
        <div class="mx-auto max-w-7xl grid-cols-1 px-6 lg:px-8">

            <header class="grid-cols-1 justify-center">
                <h1 class="font-weight-bolder text-center text-2xl uppercase">Sistema de Pedidos</h1>
            </header>

            <main class="py-4">
                @yield('contents')
            </main>
        </div>
        <footer class="flex justify-center">
            Teste Ti9 - Júnior Moreira (Khaled)
        </footer>
    </div>
</body>

</html>
