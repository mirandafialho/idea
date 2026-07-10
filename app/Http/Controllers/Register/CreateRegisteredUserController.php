<?php

declare(strict_types=1);

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class CreateRegisteredUserController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('auth.register');
    }
}
