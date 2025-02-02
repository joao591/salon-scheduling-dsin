@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Editar Cliente</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Nome -->
        <div class="mb-4">
            <label for="nome" class="block text-gray-700">Nome</label>
            <input type="text" name="nome" id="nome" class="w-full border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('nome', $cliente->nome) }}" required>
        </div>

        <!-- E-mail -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $cliente->email) }}" required>
        </div>

        <!-- Telefone -->
        <div class="mb-4">
            <label for="telefone" class="block text-gray-700">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="w-full border-gray-300 rounded-lg p-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('telefone', $cliente->telefone) }}" required>
        </div>

        <!-- Botões -->
        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Salvar Alterações</button>
            <a href="{{ route('clientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">Cancelar</a>
        </div>
    </form>
</div>
@endsection
