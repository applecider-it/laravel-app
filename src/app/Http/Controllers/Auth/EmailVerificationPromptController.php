<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * メール認証必須ページ
 * 
 * verifiedミドルウェアがあるページでは、メール確認がされていないときは、この画面に来る
 */
class EmailVerificationPromptController extends Controller
{
    /**
     * メール認証の案内を表示
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}
