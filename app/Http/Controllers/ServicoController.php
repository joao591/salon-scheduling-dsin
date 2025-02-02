<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    // Método para listar todos os serviços
    public function index()
    {
        $servicos = Servico::all(); // Pega todos os serviços cadastrados
        return view('servicos.index', compact('servicos'));
    }

    // Método para exibir o formulário de criação de um novo serviço
    public function create()
    {
        return view('servicos.create');
    }

    // Método para armazenar o novo serviço no banco de dados
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
        ]);

        // Criar o serviço
        Servico::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return redirect()->route('servicos.index')->with('success', 'Serviço criado com sucesso!');
    }

    // Método para editar um serviço existente
    public function edit($id)
    {
        $servico = Servico::findOrFail($id);
        return view('servicos.edit', compact('servico'));
    }

    // Método para atualizar um serviço
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
        ]);

        $servico = Servico::findOrFail($id);
        $servico->update([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    // Método para excluir um serviço
    public function destroy($id)
    {
        $servico = Servico::findOrFail($id);
        $servico->delete();

        return redirect()->route('servicos.index')->with('success', 'Serviço excluído com sucesso!');
    }
}
