<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * パスワードの確認処理
 * 
 * password.confirmミドルウェアがあるページでは、パスワード認証がされていないときは、この画面に来る
 */
class ConfirmablePasswordController extends Controller
{
    /**
     * パスワード確認画面を表示
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * ユーザーのパスワードを確認
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
