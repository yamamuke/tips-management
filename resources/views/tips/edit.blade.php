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

      <h1 class="fs-2">Tipの編集</h1>

      <div class="mt-3">
        <a href="#" onclick="history.back()">&lt; 前のページに戻る</a>
      </div>

      <form action="{{ route('tips.update', $tip) }}" method="post">
        @csrf
        @method('patch')
        <div>
          <div class="mt-3">
            <label for="name">タイトル</label>
            <input type="text" class="form-control mt-1" name="title" value="{{ old('title', $tip->title) }}">
          </div>
          <div class="mt-3">
            <label for="category_id">カテゴリーの選択</label>
            <div class="d-flex flex-wrap">
              @foreach ($categories->orderBy('name', 'asc')->get() as $category)
                <label>
                  <div class="d-flex align-items-center mt-2 me-3">
                    @if ($tip->categories()->where('category_id', $category->id)->exists())
                      <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" checked>
                    @else
                      <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                    @endif
                    <span class="badge bg-secondary ms-1 fw-light">{{ $category->name }}</span>
                  </div>
                </label>
              @endforeach
            </div>
          <div class="mt-4">
            <label for="content" class="mb-2" style="display: block;">Tip詳細</label>
            <textarea id="ckeditor3" name="content">{{ old('content', $tip->content) }}</textarea>
          </div>
          <!-- public/ckeditor/ckeditor.jsを呼び出してid=ckeditor3に適用 -->
          <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
          <script type="text/javascript">CKEDITOR.replace( 'ckeditor3' );</script>

          <div class="mt-2">
            <button type="submit" class="btn btn-primary">更新</button>
          </div>
        </div>
      </form>
    </div>
  </article>
@endsection
