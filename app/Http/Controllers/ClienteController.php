<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|string|max:20',
        ]);

        $cliente = Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    // Listar todos os clientes
    public function index()
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id, // Exclui o próprio e-mail do cliente da validação
            'telefone' => 'required|string|max:20',
        ]);

        // Atualizar os dados do cliente
        $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente alterado com sucesso!');
    }

    // Exibir um cliente específico
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    // Método para excluir um cliente
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Erro ao excluir o cliente. Verifique se ele possui agendamentos vinculados.');
        }
    }
}
