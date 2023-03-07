@extends('layouts.app')

@section('contents')
    <div class="card-header">
        <a class="inline-flex w-full justify-center rounded-md bg-emerald-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-400"
            href="{{ route('pedidos.lista') }}">Voltar</a>
    </div>

    <h2 class="font-weight-bolder my-6 text-3xl">Entrega Normal</h2>

    @foreach ($relatorio->normal as $grupo)
        <div class="my-4 overflow-hidden bg-gray-700 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-base font-semibold leading-6 text-white">Caminhão: {{ $grupo['caminhao'] }} - UF:
                    {{ $grupo['uf'] }}</h3>
                <p class="mt-1 max-w-2xl text-sm uppercase text-gray-200">Peso Total: {{ $grupo['peso_total'] }} KG</p>
            </div>
            @foreach ($grupo['clientes'] as $cliente)
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-700">
                                <p class="text-gray-800">{{ $cliente['nome'] }}</p>
                            </dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                @foreach ($cliente['produtos'] as $produto)
                                    <p class="text-gray-800">{{ $produto['nome'] }}</p>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>
            @endforeach
        </div>
    @endforeach

    <h2 class="font-weight-bolder my-6 text-3xl">Entrega Especial</h2>

    @foreach ($relatorio->especial as $grupo)
        <div class="my-4 overflow-hidden bg-gray-700 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-base font-semibold leading-6 text-white">Caminhão: {{ $grupo['caminhao'] }}</h3>
                <p class="mt-1 max-w-2xl text-sm uppercase text-gray-200">Peso Total: {{ $grupo['peso_total'] }} KG</p>
            </div>
            @foreach ($grupo['clientes'] as $cliente)
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-700">
                                <p class="text-gray-800">{{ $cliente['nome'] }}</p>
                            </dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                @foreach ($cliente['produtos'] as $produto)
                                    <p class="text-gray-800">{{ $produto['nome'] }}</p>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
