@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Cadastrar Cliente</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4 dark:bg-red-600 dark:text-red-200">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">E-mail</label>
            <input type="email" name="email" id="email" class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <div class="mb-4">
            <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="w-full border-gray-300 dark:border-gray-600 rounded-lg shadow-sm dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition duration-300">Salvar</button>
    </form>
</div>
@endsection
