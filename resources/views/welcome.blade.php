<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite('resources/css/app.css')

</head>

<body class="antialiased">
    <div class="relative isolate min-h-screen overflow-hidden bg-gray-900 sm:py-10">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <header>
                HEADER
            </header>

            <div>
                <a href="{{ route('gerar_entrega') }}">Gerar Separação Entregas</a>
            </div>

            <main>
                <section class="container mx-auto px-4">
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>
                                        @foreach ($cliente->produtos as $produto)
                                            | {{ $produto->nome }} |
                                        @endforeach
                                    </td>
                                    <td><input type="button" value="">Excluir</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </main>

            <footer>Teste Ti9 - Júnior Moreira (Khaled)</footer>
        </div>
    </div>
</body>

</html>
