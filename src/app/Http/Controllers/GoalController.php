<?php

namespace App\Http\Controllers;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateGoalRequest;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    
    public function edit()
   {
    $user = auth()->user();
    $targetWeight = $user->weightTarget; // リレーションがある想定

    return view('weight_logs.goal_setting', compact('targetWeight'));
    }

    public function update(UpdateGoalRequest $request)
   {
    $request->validate([
        'target_weight' => 'required|numeric|min:20|max:300',
    ]);

    $user = auth()->user();

    $target = $user->weightTarget;

        if (!$target) {
            $target = new WeightTarget();
            $target->user_id = $user->id;
        }

        $target->target_weight = $request->input('target_weight');
        $target->save();

        return redirect()->route('goal.edit')->with('success', '目標体重を更新しました');
    }


}
