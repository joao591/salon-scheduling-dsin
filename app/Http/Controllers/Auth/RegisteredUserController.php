<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cliente;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Verificar se o cliente já existe
        $cliente = Cliente::where('email', $request->email)->first();

        if (!$cliente) {
            // Se o cliente não existir, cria um novo cliente
            $cliente = Cliente::create([
                'nome' => $request->name,   // Aqui assumimos que o nome do cliente é o mesmo do usuário
                'email' => $request->email, // E-mail do cliente
                'telefone' => $request->telefone,           // Telefone do cliente
            ]);
        }

        // Criar o usuário com o cliente_id vinculado
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cliente_id' => $cliente->id, // Aqui estamos atribuindo o cliente_id ao usuário
        ]);

        // Realizar o login do usuário
        event(new Registered($user));
        Auth::login($user);

        // Redirecionar para a página de agendamentos do cliente
        return redirect()->route('agendamentos.index', ['id' => $cliente->id]);
    }

}
