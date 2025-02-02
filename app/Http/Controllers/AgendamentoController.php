<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    // Método para exibir o formulário de agendamento
    public function create()
    {
        $servicos = Servico::all(); // Obtemos todos os serviços disponíveis

        $clientes = Cliente::all(); // Obtemos todos os clientes disponíveis
        return view('agendamentos.create', compact('servicos', 'clientes'));
    }

    // Método para armazenar o agendamento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'data_agendamento' => 'required|date|after_or_equal:today',
            'hora_agendamento' => 'required|date_format:H:i',
            'servicos' => 'required|array',  // Serviços selecionados
        ]);

        // Verificar se o cliente já tem agendamento para a mesma semana
        $cliente = Cliente::findOrFail($request->cliente_id);
        $semana_agendada = Carbon::parse($request->data_agendamento)->weekOfYear;
        $agendamentoExistente = Agendamento::where('cliente_id', $cliente->id)
            ->whereBetween('data_agendamento', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->exists();

        if ($agendamentoExistente) {
            // Sugere o mesmo dia da semana para o próximo agendamento
            return back()->with('aviso', 'Você tem um agendamento na mesma semana, seria interessante agendar para o mesmo dia.');
        }

        // Criar o agendamento
        $agendamento = Agendamento::create([
            'cliente_id' => $request->cliente_id,
            'data_agendamento' => $request->data_agendamento,
            'hora_agendamento' => $request->hora_agendamento,
        ]);

        // Associar os serviços ao agendamento
        $agendamento->servicos()->attach($request->servicos);

        // Verificar se o usuário logado é admin e redirecionar
        if (Auth::user() && Auth::user()->role === 'admin') {
            return redirect()->route('agendamentos.listar')->with('success', 'Agendamento realizado com sucesso!');
        }

        return redirect()->route('agendamentos.index', ['id' => $request->cliente_id])->with('success', 'Agendamento realizado com sucesso!');
    }

    // Método para alterar o agendamento (considerando a regra de até 2 dias)
    public function edit($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $servicos = Servico::all();
        return view('agendamentos.edit', compact('agendamento', 'servicos'));
    }

    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);

        // Verificar se a alteração pode ser feita
        if (Auth::user() && Auth::user()->role === 'user') {
            $dataLimiteAlteracao = Carbon::parse($agendamento->data_agendamento)->subDays(2);
            if (Carbon::now()->isAfter($dataLimiteAlteracao)) {
                return back()->with('erro', 'Alterações podem ser feitas até 2 dias antes do agendamento. Para alterações posteriores, por favor, entre em contato por telefone.');
            }
        }

        // Atualizar os dados do agendamento
        $agendamento->update([
            'data_agendamento' => $request->data_agendamento,
            'hora_agendamento' => $request->hora_agendamento,
        ]);

        // Atualizar os serviços
        $agendamento->servicos()->sync($request->servicos);

        // Verificar se o usuário logado é admin e redirecionar
        if (Auth::user() && Auth::user()->role === 'admin') {
            return redirect()->route('agendamentos.listar')->with('success', 'Agendamento alterado com sucesso!');
        }

        $cliente = Cliente::where('email', Auth::user()->email)->first();

        return redirect()->route('agendamentos.index', ['id' => $cliente->id])->with('success', 'Agendamento alterado com sucesso!');
    }

    // Método para exibir o histórico de agendamentos
    public function index(Request $request)
    {
        if (!$request->user() || !$request->user()->id) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para ver seus agendamentos.');
        }
        $clienteId = $request['id']; // Obter o cliente logado
        $agendamentos = Agendamento::where('cliente_id', $clienteId)
            ->whereDate('data_agendamento', '>', Carbon::now()->toDateString()) // Comparar apenas a data
            ->orderBy('data_agendamento')->orderBy('hora_agendamento')
            ->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    // Método para listar todos os agendamentos no sistema (para o administrador)
    public function listarTodos()
    {
        $agendamentos = Agendamento::orderBy('data_agendamento')->orderBy('hora_agendamento')->get();
        return view('agendamentos.listar', compact('agendamentos'));
    }

    // Método para confirmar o agendamento (admin)
    public function confirmar($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update(['status' => 'confirmado']); // Exemplo de status "confirmado"
        return back()->with('success', 'Agendamento confirmado com sucesso!');
    }
}
