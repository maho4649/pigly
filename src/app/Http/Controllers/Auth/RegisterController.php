<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('auth.step1');
    }

    public function processStep1(RegisterStep1Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user); // ← 自動ログイン
    
        return redirect()->route('register.step2');
    }
    
    public function showStep2()
    {
    return view('auth.step2');
    }

     public function processStep2(RegisterStep2Request $request)
 {
     $request->validate([
        'latest_weight' => ['required', 'numeric', 'min:20', 'max:300'],
        'target_weight' => ['required', 'numeric', 'min:20', 'max:300'],
     ]);

      WeightTarget::create([
        'user_id' => auth()->id(),
        'target_weight' => $request->input('target_weight'),
      ]);

      WeightLog::create([
        'user_id' => auth()->id(),
        'weight' => $request->input('latest_weight'),
        'date' => Carbon::today(), 
        'calories' => 0,            
        'exercise_time' => 0,       
        'exercise_content' => null, 
    ]);

      return redirect()->route('weight_logs.index');
  }
}
