<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginViewResponse;

class CustomLoginViewResponse implements LoginViewResponse
{
    public function toResponse($request)
    {
        return view('auth.login');
    }
}
