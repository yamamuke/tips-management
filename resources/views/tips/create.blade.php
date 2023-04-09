@extends('layouts.app')

@section('content')
  <article class="tips">
    <div class="container h-100">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <h1>Tipの追加</h1>

      <div>
        <a href="{{ route('tips.index') }}">&lt; 戻る</a>
      </div>

      <form action="{{ route('tips.store') }}" method="post">
        @csrf
        <div class="mt-2">
          <label for="name">タイトル</label>
          <input type="text" class="form-control mt-1" name="title" value="{{ old('title') }}">
        </div>
        <div class="mt-2">
          <label for="category_id">カテゴリー</label>
          <input type="text" class="form-control mt-1" name="category_id" value="{{ old('category_id') }}">
        </div>
        <div class="mt-2">
          <label for="content" style="display: block;">Tip詳細</label>
          <textarea id="ckeditor1" name="content" cols="55" rows="10">{{ old('content') }}</textarea>
        </div>
        <!-- public/ckeditor/ckeditor.jsを呼び出してid=ckeditor1に適用 -->
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript">CKEDITOR.replace( 'ckeditor1' );</script>
        
        <div class="mt-2">
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </article>
@endsection
