<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * パスワード再発行用のメール送信処理
 */
class PasswordResetLinkController extends Controller
{
    /**
     * パスワードリセットリンクを要求する画面
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * パスワードリセットリンクの要求
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            rules: [
                'email' => ['required', 'email'],
            ],
            attributes: [
                'email' => __('app.models.user.columns.email'),
            ]
        );

        // このユーザーに対してパスワードリセット用リンクを送信します。
        // リンクの送信を試みた後、その応答を確認し、ユーザーに提示すべきメッセージを判断します。
        // 最後に、適切な応答を返します。
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
