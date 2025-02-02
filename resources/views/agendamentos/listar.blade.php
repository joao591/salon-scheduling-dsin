@extends('layouts.app')

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Meus Agendamentos</h2>
@endsection

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Lista de Agendamentos</h2>
        <a href="{{ route('agendamentos.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 dark:bg-indigo-800 dark:hover:bg-indigo-700 transition duration-300">Adicionar Agendamento</a>
    </div>

    @if($agendamentos->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-300">Não há agendamentos no momento.</p>
    @else
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-900">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Cliente</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Data</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Hora</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Serviços</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendamentos as $agendamento)
                    @if ($agendamento->cliente)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $agendamento->cliente->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($agendamento->data_agendamento)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($agendamento->hora_agendamento)->format('H:i') }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                @foreach($agendamento->servicos as $servico)
                                    <span class="block">{{ $servico->nome }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $agendamento->status == 'confirmado' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                    {{ ucfirst($agendamento->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                <div class="flex space-x-2">
                                    @if($agendamento->status != 'confirmado')
                                        <form action="{{ route('agendamentos.confirmar', $agendamento->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded-md hover:bg-green-600 transition duration-300 dark:bg-green-700 dark:hover:bg-green-600">Confirmar</button>
                                        </form>
                                    @else
                                        <span class="text-green-500 font-semibold">Confirmado</span>
                                    @endif

                                    <!-- Botão Editar -->
                                    <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="flex items-center bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828zM4 16v-2.828L14.586 2.586a4 4 0 015.656 5.656L9.828 18H4a2 2 0 01-2-2v-2z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
