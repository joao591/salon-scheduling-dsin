@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Serviços</h2>
@endsection

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Serviços</h2>

    <a href="{{ route('servicos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4 inline-block">
    Adicionar Novo Serviço
    </a>

    @if($servicos->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Não há serviços cadastrados.</p>
    @else
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Nome</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Preço</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicos as $servico)
                    <tr class="border-t border-gray-300 dark:border-gray-600">
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">{{ $servico->nome }}</td>
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">R$ {{ number_format($servico->preco, 2, ',', '.') }}</td>
                        <td class="py-4 px-4 text-sm">
                            <a href="{{ route('servicos.edit', $servico->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Editar</a>
                            <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300" onclick="return confirm('Tem certeza que deseja excluir este serviço?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
