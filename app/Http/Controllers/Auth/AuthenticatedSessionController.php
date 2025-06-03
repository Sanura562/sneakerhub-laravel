<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
       switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'user':
                return redirect()->route('index');
            default:
                return redirect('index'); // Fallback for unexpected roles
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();       // ✅ clear session
    $request->session()->regenerateToken();  // ✅ regenerate CSRF token

    return redirect('/login');               // ✅ redirect to login
}
}