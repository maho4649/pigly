@extends('layouts.app')

@section('content')
<style>
    .narrow-container {
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<div class="container narrow-container">
    <h1>Weight Log</h1>

    <form method="POST" action="{{ route('weight_logs.update', $log->id) }}">
        @csrf
        @method('PUT')

        <!-- 日付 -->
        <div class="mb-3">
            <label class="form-label">日付</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $log->date) }}" >
            @error('date')
              <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <!-- 体重 -->
        <div class="mb-3">
            <label class="form-label">体重</label>
            <div class="input-group">
              <input type="number" step="0.1" name="weight" class="form-control" value="{{ old('weight', $log->weight) }}" >
              <span class="input-group-text">kg</span>
            </div>

             @error('weight')
              <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <!-- 摂取カロリー -->
        <div class="mb-3">
            <label class="form-label">摂取カロリー</label>
            <div class="input-group">
              <input type="number" name="calories" class="form-control" value="{{ old('calories', $log->calories) }}" >
              <span class="input-group-text">kcal</span>
            </div>
            @error('calories')
              <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <!-- 運動時間 -->
        <div class="mb-3">
            <label class="form-label">運動時間</label>
            <input type="time" name="exercise_time" class="form-control" 
  value="{{ old('exercise_time', \Illuminate\Support\Str::substr($log->exercise_time, 0, 5)) }}">

            @error('exercise_time')
              <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>

        <!-- 運動内容 -->
        <div class="mb-3">
            <label class="form-label">運動内容</label>
            <input type="text" name="exercise_content" class="form-control" value="{{ old('exercise_content', $log->exercise_content) }}">
            @error('exercise_content')
              <div class="text-danger">{{ $message }}</div>
             @enderror
        </div>
       
        <div class="d-flex justify-content-center mt-4">
          <div>
             <button type="submit" class="btn btn-primary">更新する</button>
              <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
          </div>
        </div>
    </form>
    
    <form method="POST" action="{{ url('/weight_logs/' . $log->id . '/delete') }}" onsubmit="return confirm('本当に削除しますか？')">
         @csrf
         @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-danger">🗑️</button>
    </form>
</div>
@endsection
