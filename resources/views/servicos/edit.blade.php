@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Editar Serviço</h2>

    <form action="{{ route('servicos.update', $servico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="nome" class="block text-gray-700 dark:text-gray-200">Nome</label>
            <input type="text" id="nome" name="nome" class="form-input mt-1 block w-full" value="{{ old('nome', $servico->nome) }}" required>
        </div>

        <div class="mb-4">
            <label for="preco" class="block text-gray-700 dark:text-gray-200">Preço</label>
            <input type="number" id="preco" name="preco" class="form-input mt-1 block w-full" value="{{ old('preco', $servico->preco) }}" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Salvar Alterações</button>
    </form>
</div>
@endsection
