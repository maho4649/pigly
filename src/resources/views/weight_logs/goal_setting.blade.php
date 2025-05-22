@extends('layouts.app')

@section('content')
<style>
    .narrow-container {
        max-width: 600px;
        margin: 0 auto;
    }
    

</style>

<div class="container narrow-container">
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('goal.update') }}">
    <h1 class="text-center">目標体重設定</h1>
        @csrf

        <div class="mb-3">
            <label for="target_weight" class="form-label"></label>
            <div class="input-group">
              <input type="number" step="0.1" name="target_weight" id="target_weight" class="form-control" 
                   value="{{ old('target_weight', $targetWeight?->target_weight) }}" >
              <span class="input-group-text">kg</span>
            </div>
               @error('target_weight')
                <div class="error-message">{{ $message }}</div>
               @enderror
        </div>

        <div class="d-flex justify-content-center mt-4">
          <div>
           <button type="submit" class="btn btn-primary">更新</button>
            <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
           </div>
        </div>
    </form>
</div>
@endsection
