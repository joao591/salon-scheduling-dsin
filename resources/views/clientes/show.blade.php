@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Detalhes do Cliente</h2>

    <div class="bg-white dark:bg-gray-800 shadow-md p-6 rounded-lg">
        <p><strong class="text-gray-800 dark:text-gray-200">Nome:</strong> {{ $cliente->nome }}</p>
        <p><strong class="text-gray-800 dark:text-gray-200">E-mail:</strong> {{ $cliente->email }}</p>
        <p><strong class="text-gray-800 dark:text-gray-200">Telefone:</strong> {{ $cliente->telefone }}</p>
    </div>

    <div class="mt-6 flex gap-4">
        <a href="{{ route('clientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 transition duration-300">Voltar</a>
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700 transition duration-300">Editar</a>
        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 transition duration-300">Excluir</button>
        </form>
    </div>
</div>
@endsection
