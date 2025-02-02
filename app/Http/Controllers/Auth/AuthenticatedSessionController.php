<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cliente;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Verificar se o usuário logado é admin e redirecionar
        if ($user && $user->role === 'admin') {
            return redirect()->route('agendamentos.listar');
        }

        // Verificar o cliente correspondente ao e-mail do usuário logado
        $cliente = Cliente::where('email', $user->email)->first();

        if ($cliente) {
            // Redireciona para a página de agendamentos com o ID do cliente
            return redirect()->route('agendamentos.index', ['id' => $cliente->id]);
        }

        // Se não houver cliente correspondente, redireciona para uma página de erro
        return redirect()->route('dashboard')->with('error', 'Cliente não encontrado.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
