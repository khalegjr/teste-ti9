@extends('layouts.app')

@section('contents')
    <div class="row px-4 py-6">
        <a class="ease focus:shadow-outline m-2 select-none rounded-md border border-green-500 bg-green-500 px-4 py-2 text-white transition duration-500 hover:bg-green-600 focus:outline-none"
            href="{{ route('pedidos.gerar.entrega') }}">Gerar Separação Entregas</a>
    </div>
    <section class="container mx-auto px-4">
        @foreach ($clientes as $cliente)
            <div class="my-4 overflow-hidden bg-gray-700 shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-white">{{ $cliente->nome }}</h3>
                    <p class="mt-1 max-w-2xl text-sm uppercase text-gray-200">{{ $cliente->uf }}</p>
                    <a href="{{ route('pedidos.novo', ['cliente' => $cliente->id]) }}" x-data="{ tooltip: 'Novo' }">
                        <div class="align-items-center flex justify-end gap-1 px-2">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z"
                                    clip-rule="evenodd" />
                            </svg> NOVO PEDIDO
                        </div>
                    </a>
                </div>
                @foreach ($cliente->produtos as $produto)
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-700">{{ $produto->nome }}</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                    <div class="flex justify-end gap-4">
                                        <form
                                            action="{{ route('pedidos.excluir', [
                                                'cliente' => $cliente->id,
                                            ]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <input name="produto" type="hidden" value="{{ $produto->id }}">
                                            <button x-data="{ tooltip: 'Delete' }">
                                                <svg class="text-black-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                    fill="black" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" x-tooltip="tooltip">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </dd>
                            </div>
                        </dl>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection
