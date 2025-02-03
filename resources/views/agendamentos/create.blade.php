@extends('layouts.app')

@section('content')

@section('title', 'Cadastro de Agendamento')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Criar Agendamento</h2>

    <!-- Exibição de avisos -->
    @if(session('aviso'))
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded mb-4">
            {{ session('aviso') }}
        </div>
    @endif

    <form  method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Cliente -->
            @if(Auth::user() && Auth::user()->role === 'admin')
                <div class="col-span-1">
                    <label for="cliente_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500">
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>
            @else
            @php
                $cliente = \App\Models\Cliente::where('email', Auth::user()->email)->first();
            @endphp
                <!-- Campo oculto com ID do cliente para usuário comum -->
                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
            @endif

            <!-- Data do Agendamento -->
            <div class="col-span-1">
                <label for="data_agendamento" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Data do Agendamento</label>
                <input type="date" name="data_agendamento" id="data_agendamento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500" required>
            </div>

            <!-- Hora do Agendamento -->
            <div class="col-span-1">
                <label for="hora_agendamento" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Hora do Agendamento</label>
                <input type="time" name="hora_agendamento" id="hora_agendamento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500" required>
            </div>
        </div>

        <!-- Serviços -->
        <div>
            <label for="servicos" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Serviços</label>
            <select name="servicos[]" id="servicos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:ring-indigo-500" multiple required>
                @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botão de Enviar -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 dark:bg-indigo-800 dark:hover:bg-indigo-700 transition duration-300">Criar Agendamento</button>
        </div>
    </form>
</div>
@endsection
