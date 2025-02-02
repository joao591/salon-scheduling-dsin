@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Meus Agendamentos</h2>
@endsection

@section('content')
<div class="container mx-auto p-6">
<div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Agendamentos</h2>
        <a href="{{ route('agendamentos.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 dark:bg-indigo-800 dark:hover:bg-indigo-700 transition duration-300">Adicionar Agendamento</a>
    </div>

    <!-- Se não houver agendamentos, exibe uma mensagem -->
    @if($agendamentos->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Não há agendamentos futuros para este cliente.</p>
    @else
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Cliente</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Data</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Hora</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Serviços</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Status</th>
                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 dark:text-gray-200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendamentos as $agendamento)
                    <tr class="border-t border-gray-300 dark:border-gray-600">
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">{{ $agendamento->cliente->nome }}</td>
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::parse($agendamento->data_agendamento)->format('d/m/Y') }}</td>
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::parse($agendamento->hora_agendamento)->format('H:i') }}</td>
                        <td class="py-4 px-4 text-sm text-gray-800 dark:text-gray-300">
                            @foreach($agendamento->servicos as $servico)
                                <span class="block">{{ $servico->nome }}</span>
                            @endforeach
                        </td>
                        <td class="py-4 px-4 text-sm">
                            @if($agendamento->status != 'confirmado')
                                <span class="text-yellow-500">Pendente</span>
                            @else
                                <span class="text-green-500">Confirmado</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-sm">
                            <div class="flex space-x-2">
                                <!-- Botão Editar -->
                                <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="flex items-center bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828zM4 16v-2.828L14.586 2.586a4 4 0 015.656 5.656L9.828 18H4a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
