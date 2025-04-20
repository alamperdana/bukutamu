<?php

namespace App\Http\Controllers\Auth;

use App\Models\Tahun;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $tahun = Tahun::orderBy('tahun', 'asc')->get();
        return view('auth.login', compact('tahun'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        $request->session()->regenerate();

        $request->user()->update([
            'session_id' => Session::getId(),
            'last_login' => Carbon::now()->toDateTimeString(),
            'login_ip' => $request->getClientIp()
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * 
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /**
         * @var \App\Models\User $user
         */
        
        $user = Auth::user();
        if ($user) {
            $user->session_id = null; // Clear session ID
            $user->save();
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
