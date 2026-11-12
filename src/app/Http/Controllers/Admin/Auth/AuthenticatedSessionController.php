<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 管理画面のログイン、ログアウト管理
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * ログイン画面を表示
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * 認証リクエストを処理
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.home', absolute: false));
    }

    /**
     * 認証済みセッションを破棄
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('admin.login', absolute: false));
    }
}
