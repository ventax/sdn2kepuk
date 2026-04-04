<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
