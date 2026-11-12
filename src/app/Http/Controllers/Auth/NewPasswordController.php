<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * パスワードリセット処理
 * 
 * PasswordResetLinkControllerで送信されたメールから来るページ
 */
class NewPasswordController extends Controller
{
    /**
     * パスワードリセット画面
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * 新規パスワードのリクエストを処理
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $request->validate(
            rules: [
                'token' => ['required'],
                'email' => ['required', 'email'],
                'password' => $user->validationPassword(),
            ],
            attributes: [
                'email' => __('app.models.user.columns.email'),
                'password' => __('app.models.user.columns.password'),
            ]
        );

        // ここでは、ユーザーのパスワードのリセットを試みます。
        // 成功した場合は、実際のユーザーモデル上のパスワードを更新し、それをデータベースに保存します。
        // 失敗した場合は、エラーを解析してレスポンスを返します。
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // パスワードの再設定が正常に完了した場合は、ユーザーをログイン画面へリダイレクトします。
        // エラーが発生した場合は、エラーメッセージを添えて、ユーザーを元の画面へリダイレクトします。
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
