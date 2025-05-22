<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// トップページ（体重管理画面）
Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');

   // 体重登録フォーム表示・登録
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');

   // 体重検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

   

   // 体重更新フォーム表示・更新処理
    Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weightLogId}', [WeightLogController::class, 'update'])->name('weight_logs.update');

   // 体重削除
    Route::delete('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

   // 目標体重設定test
    Route::get('/weight_logs/goal_setting', [GoalController::class, 'edit'])->name('goal.edit');
    Route::post('/weight_logs/goal_setting', [GoalController::class, 'update'])->name('goal.update');
  });

// 会員登録（step1: 基本情報登録）
Route::get('/register/step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1']);

// 会員登録（step2: 初期目標体重登録）
Route::middleware('auth')->group(function (){
    Route::get('/register/step2', [RegisterController::class, 'showStep2'])->name('register.step2');
    Route::post('/register/step2', [RegisterController::class, 'processStep2']);
});




