<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LogoutResponse;

class CustomLogoutResponse implements LogoutResponse
{
    public function toResponse($request)
    {
        return redirect()->route('login'); // ← ここでログアウト後の遷移先を設定
    }
}
