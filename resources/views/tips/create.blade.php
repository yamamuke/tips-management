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

      <div class="mt-3">
        <a href="{{ route('tips.index') }}">&lt; 戻る</a>
      </div>

      <form action="{{ route('tips.store') }}" method="post">
        @csrf
        <div class="mt-3">
          <label for="name">タイトル</label>
          <input type="text" class="form-control mt-1" name="title" value="{{ old('title') }}">
        </div>
        <div class="mt-3">
          <label for="category_id">カテゴリーの選択</label>
        </div>
        <!-- category_idを持ったcheckboxとbadgeスタイルのcategory_nameのリストを並べる -->
        <div class="d-flex flex-wrap">
          @foreach($categories->orderBy('name', 'asc')->get() as $category)
            <label>
              <div class="d-flex align-items-center mt-3 me-3">
                <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                <span class="badge bg-secondary ms-1 fw-light">{{ $category->name }}</span>
              </div>
            </label>
          @endforeach
        </div>
        <div class="mt-4">
          <label for="content" class="mb-2" style="display: block;">Tip詳細</label>
          <textarea id="ckeditor1" name="content">{{ old('content') }}</textarea>
        </div>
        <!-- public/ckeditor/ckeditor.jsを呼び出してid=ckeditor1に適用 -->
        <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript">CKEDITOR.replace( 'ckeditor1' );</script>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </article>
@endsection
