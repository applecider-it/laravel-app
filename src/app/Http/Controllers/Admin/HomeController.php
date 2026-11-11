<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * ホームコントローラー
 */
class HomeController extends Controller
{
    public function __construct(
    ) {}

    public function index(Request $request)
    {
        return view('admin.home.index');
    }
}
