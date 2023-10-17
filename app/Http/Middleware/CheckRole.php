<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) // Se o usuário não estiver autenticado, redirecione para a página de login
            return redirect('login');

        $user = Auth::user();

        if ($user && in_array($user->role, $roles)) { // Verifique se o usuário tem o role necessário
            return $next($request);
        }

        return redirect('home')->with('error', 'Você não tem permissão para acessar esta página.');
    }
}
