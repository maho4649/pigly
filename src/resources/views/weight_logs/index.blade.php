@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 成果エリア --}}
    <div class="mb-4 p-4 bg-light rounded shadow-sm">
     <div class="row text-center">
      <div class="col-md-4">
        <p><strong>目標体重:</strong> {{ $targetWeight }} kg</p>
      </div>
      <div class="col-md-4">
        <p><strong>最新の体重:</strong> {{ $latestWeight }} kg</p>
      </div>
      <div class="col-md-4">
        <p><strong>目標まで:</strong> {{ number_format($latestWeight - $targetWeight, 1) }} kg</p>
      </div>
     </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
        {{-- 検索フォーム --}}
        <form method="GET" action="{{ route('weight_logs.index') }}" class="mb-4">
        <div class="row align-items-end">
         <!-- 日付From -->
           <div class="col-md-3">
            <input type="date" id="date_from" name="date_from" class="form-control" value="{{ request('date_from') }}">
           </div>

         <!-- 〜 -->
           <div class="col-md-1 text-center d-flex align-items-end justify-content-center">
            <span class="mb-2">〜</span>
           </div>

         <!-- 日付To -->
          <div class="col-md-3">
              <input type="date" id="date_to" name="date_to" class="form-control" value="{{ request('date_to') }}">
          </div>

          <!-- 検索 + リセット -->
           <div class="col-md-3 d-flex">
              <button type="submit" class="btn btn-primary me-2">検索</button>
                 @if(request('date_from') || request('date_to'))
                 <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">リセット</a>
                @endif
              </div>

           <!-- データ追加（右寄せ） -->
              <div class="col-md-2 text-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLogModal"> データを追加</button>
              </div>
             </div>
            </form>
      
        @if(request('date_from') || request('date_to'))
         <div class="alert alert-info">
          検索結果：
          @if(request('date_from'))
            {{ request('date_from') }} ～
          @endif
          @if(request('date_to'))
            {{ request('date_to') }}
          @endif
          の検索結果 {{ $logs->total() }}件
         </div>
        @endif


       <!-- 一覧表示 -->
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>日付</th>
                        <th>体重 (kg)</th>
                        <th>食事摂取カロリー (kcal)</th>
                        <th>運動時間</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                            <td>{{ $log->weight }}kg</td>
                            <td>{{ $log->calories }}kcal</td>
                            <td>{{ $log->exercise_time }}</td>
                            <td>
                              <a href="{{ route('weight_logs.edit', $log->id) }}" class="btn btn-sm btn-outline-secondary ms-2">✏️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">記録がありません</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- モーダル -->
<div class="modal fade" id="addLogModal" tabindex="-1" aria-labelledby="addLogModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('weight_logs.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addLogModalLabel">新規データ登録</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
        </div>
        <div class="modal-body">
          <!-- 日付 -->
          <div class="mb-3">
            <label for="date" class="form-label">日付</label>
            <input type="date" class="form-control" name="date" value="{{ now()->format('Y-m-d') }}" >
            @error('date')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>

          <!-- 体重 -->
          <div class="mb-3">
            <label for="weight" class="form-label">体重</label>
            <input type="number" step="0.1" class="form-control" name="weight" value="{{ old('weight') }}" >
            @error('weight')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>

          <!-- 摂取カロリー -->
          <div class="mb-3">
            <label for="calories" class="form-label">摂取カロリー</label>
            <input type="number" class="form-control" name="calories" >
            @error('calories')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>

          <!-- 運動時間 -->
          <div class="mb-3">
            <label for="exercise_time" class="form-label">運動時間</label>
            <input type="time" class="form-control" name="exercise_time" >
            @error('exercise_time')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>

          <!-- 運動内容 -->
          <div class="mb-3">
            <label for="exercise_content" class="form-label">運動内容</label>
            <input type="text" class="form-control" name="exercise_content">
            @error('exercise_content')
              <div class="text-danger">{{ $message }}</div>
             @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">登録</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
        </div>
      </div>
    </form>
  </div>
</div>
@if ($errors->any())
    <script>
        // ページ読み込み後にモーダルを表示
        window.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('addLogModal'));
            modal.show();
        });
    </script>
@endif
{{-- ページネーション --}}
    <div class="mt-3">
        {{ $logs->links() }}
    </div>
@endsection
