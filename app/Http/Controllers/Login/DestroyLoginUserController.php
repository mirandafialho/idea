<?php

declare(strict_types=1);

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class DestroyLoginUserController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }
}
