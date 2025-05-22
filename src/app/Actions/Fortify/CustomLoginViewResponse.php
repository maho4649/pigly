<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginViewResponse as LoginResponseContract;
use Illuminate\Http\Request;

class CustomLoginViewResponse implements LoginViewResponse
{
    public function toResponse($request)
    {
        return redirect('/login');
    }
}
