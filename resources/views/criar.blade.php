@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-xl uppercase">{{ $cliente->nome }} - {{ $cliente->uf }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-1 md:gap-6">

            <div class="card flex justify-end">
                <div class="card-header">
                    <a class="inline-flex justify-center rounded-md bg-emerald-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-400"
                        href="{{ route('pedidos.lista') }}">Voltar</a>
                </div>
            </div>

            <div class="mt-5 bg-gray-700 md:col-span-2 md:mt-0">
                <form action="{{ route('pedidos.salvar', ['cliente' => $cliente->id]) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium leading-6" for="produto">Produto</label>
                                    <select
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 text-black shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        id="produto" name="produto" autocomplete="produto.nome">
                                        <option class="text-gray-900">---</option>

                                        @foreach ($produtos as $produto)
                                            <option class="text-gray-900" value="{{ $produto->id }}">{{ $produto->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right sm:px-6">
                            <button
                                class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400"
                                type="submit">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
