{{-- {{ dd($relatorio) }} --}}
@foreach ($relatorio as $uf => $clientes)
    <hr>
    <p>Caminhão: {{ $clientes['caminhao'] }} Peso Total: {{ number_format($clientes['peso_total'], 3, ',', '.') }} KG
    </p>
    <p>UF: {{ $uf }}</p>
    @foreach ($clientes['clientes'] as $cliente)
        {{-- {{ dd($cliente) }} --}}
        <p>Cliente: {{ $cliente['cliente_nome'] }}</p>
        <p>Produtos</p>
        @foreach ($cliente['produtos'] as $produto)
            <p>{{ $produto['id'] }} {{ $produto['nome'] }}</p>
        @endforeach
        ---
    @endforeach
@endforeach
