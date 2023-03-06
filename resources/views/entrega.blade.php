{{-- {{ dd($relatorio['normal']) }} --}}
<h2>Normal</h2>

@foreach ($relatorio['normal'] as $grupo)
    <hr>
    <p>Caminhão: {{ $grupo['caminhao'] }} Peso Total: {{ number_format($grupo['peso_total'], 3, ',', '.') }} KG
    </p>
    <p>UF: {{ $grupo['uf'] }}</p>
    @foreach ($grupo['clientes'] as $cliente)
        {{-- {{ dd($cliente) }} --}}
        <p>Cliente: {{ $cliente['nome'] }}</p>
        <p>Produtos</p>
        @foreach ($cliente['produtos'] as $produto)
            <p>{{ $produto['id'] }} {{ $produto['nome'] }}</p>
        @endforeach
        ---
    @endforeach
@endforeach

<hr>

<h2>Normal</h2>
{{ $relatorio['especial'] }}
