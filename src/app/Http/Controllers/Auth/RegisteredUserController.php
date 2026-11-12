<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * サインアップ処理
 */
class RegisteredUserController extends Controller
{
    /**
     * 登録画面を表示
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * 新規登録リクエストを処理
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $user = new User();
        $validated = $request->validate(
            rules: [
                'name'  => $user->validationName(),
                'email' => $user->validationEmail(),
                'password' => $user->validationPassword(),
            ],
            attributes: [
                'name' => __('app.models.user.columns.name'),
                'email' => __('app.models.user.columns.email'),
                'password' => __('app.models.user.columns.password'),
            ]
        );

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
