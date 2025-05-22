<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\StoreWeightLogRequest;

class WeightLogController extends Controller
{
  // 体重ログ一覧表示用メソッド
  public function index(Request $request)
  {
      $userId = auth()->id();

      $query = WeightLog::where('user_id', $userId); 

       if ($request->filled('date_from')) {
        $query->where('date', '>=', $request->date_from);
       }
       if ($request->filled('date_to')) {
        $query->where('date', '<=', $request->date_to);
       }
    
      $logs = $query->orderBy('date', 'desc')->paginate(10)->withQueryString();
  
      $latestWeight = WeightLog::where('user_id', $userId)
          ->orderBy('date', 'desc')
          ->first()?->weight ?? 0;
  
      $targetWeight = WeightTarget::where('user_id', $userId)
          ->orderBy('updated_at', 'desc')
          ->first()?->target_weight ?? 60;
  
      return view('weight_logs.index', compact('logs', 'targetWeight', 'latestWeight'));
  }

  public function store(StoreWeightLogRequest $request)
{
    $request->validate([
        'date' => 'required|date',
        'weight' => 'required|numeric',
        'calories' => 'required|integer',
        'exercise_time' => 'required',
        'exercise_content' => 'nullable|string|max:255',
    ]);

    WeightLog::create([
        'user_id' => auth()->id(),
        'date' => $request->date,
        'weight' => $request->weight,
        'calories' => $request->calories,
        'exercise_time' => $request->exercise_time,
        'exercise_content' => $request->exercise_content,
    ]);


    return redirect()->route('weight_logs.index')->with('success', 'データを登録しました。');
  }

  public function edit($weightLogId)
  {
    $log = WeightLog::where('user_id', auth()->id())->findOrFail($weightLogId);
    return view('weight_logs.edit', compact('log'));
  }

  public function update(StoreWeightLogRequest $request, $weightLogId)
  {
      $request->validate([
          'date' => 'required|date',
          'weight' => 'required|numeric',
          'calories' => 'required|integer',
          'exercise_time' => 'required',
          'exercise_content' => 'nullable|string|max:255',
      ]);
  
      $log = WeightLog::where('user_id', auth()->id())->findOrFail($weightLogId);
  
      $log->update([
          'date' => $request->date,
          'weight' => $request->weight,
          'calories' => $request->calories,
          'exercise_time' => $request->exercise_time,
          'exercise_content' => $request->exercise_content,
      ]);
  
      return redirect()->route('weight_logs.index')->with('success', 'データを更新しました。');
  }
  
  public function destroy($id)
 {
    $log = WeightLog::where('user_id', auth()->id())->findOrFail($id);
    $log->delete();

    return redirect()->route('weight_logs.index')->with('success', '削除しました');
 }




}
