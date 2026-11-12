<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * メール認証必須ページからの送信処理
 * 
 * EmailVerificationPromptControllerからの送信を処理する
 */
class EmailVerificationNotificationController extends Controller
{
    /**
     * 新しいメール認証通知を送信
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
