<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // If no specific roles required, just allow authenticated user
        if (empty($roles)) {
            return $next($request);
        }

        // Check if user has one of the required roles
        if (!in_array($user->role, $roles)) {
            // Redirect to their appropriate dashboard or abort
            return match ($user->role) {
                'admin'    => redirect()->route('admin.dashboard'),
                'hr'       => redirect()->route('hr.dashboard'),
                'employee' => redirect()->route('employee.dashboard'),
                default    => abort(403, 'Akses ditolak. Role tidak dikenali.'),
            };
        }

        return $next($request);
    }
}