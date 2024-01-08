<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    break;
                case 'server':
                    return redirect()->route('server.dashboard');
                    break;
                case 'pengguna':
                    return redirect()->route('pengguna.dashboard');
                    break;
                // Tambahkan peran lain jika ada
                default:
                return new JsonResponse(['error' => 'Unauthorized'], 403); // Pesan JSON untuk akses terlarang
                break;
            }
        }
        return $next($request);
    }
}
