@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Alterar Agendamento</h2>

    <!-- Exibição da mensagem de erro -->
    @if(session('erro'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('erro') }}
        </div>
    @endif

    <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Data do Agendamento -->
        <div class="mb-4">
            <label for="data_agendamento" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Data</label>
            <input type="date" name="data_agendamento" id="data_agendamento" 
                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                   value="{{ $agendamento->data_agendamento }}" required>
        </div>

        <!-- Hora do Agendamento -->
        <div class="mb-4">
            <label for="hora_agendamento" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Hora</label>
            <input type="time" name="hora_agendamento" id="hora_agendamento" 
                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                   value="{{ $agendamento->hora_agendamento }}" required>
        </div>

        <!-- Serviços -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Serviços</label>
            @foreach($servicos as $servico)
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="servicos[]" value="{{ $servico->id }}" 
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                           @if($agendamento->servicos->contains($servico->id)) checked @endif>
                    <label for="servico_{{ $servico->id }}" class="ml-2 text-gray-800 dark:text-gray-200">
                        {{ $servico->nome }} - R$ {{ number_format($servico->preco, 2, ',', '.') }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Botões de Ação -->
        <div class="flex justify-between">
            <a href="{{ Auth::user() && Auth::user()->role === 'admin' ? route('agendamentos.listar') : route('agendamentos.index', ['id' => $agendamento->cliente_id]) }}" 
            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                Voltar
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Salvar Alterações
            </button>
        </div>

    </form>
</div>
@endsection
