@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Clientes</h2>
@endsection

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Lista de Clientes</h2>

    <a href="{{ route('clientes.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4 inline-block">
        + Novo Cliente
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4 dark:bg-green-600 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if ($clientes->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">Nenhum cliente cadastrado.</p>
    @else
        <table class="w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Nome</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">E-mail</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Telefone</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Ações</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 dark:text-gray-300">
                @foreach ($clientes as $cliente)
                    <tr class="border-t border-gray-300 dark:border-gray-600">
                        <td class="py-2 px-4">{{ $cliente->nome }}</td>
                        <td class="py-2 px-4">{{ $cliente->email }}</td>
                        <td class="py-2 px-4">{{ $cliente->telefone }}</td>
                        <td class="py-2 px-4 flex gap-2">
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
