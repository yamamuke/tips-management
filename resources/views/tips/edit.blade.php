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

      <h1 class="modal-title" id="editTipModalLabel{{ $tip->id}}">Tipの編集</h1>

      <div>
        <a href="#" onclick="history.back()">&lt; 前のページに戻る</a>
      </div>

      <form action="{{ route('tips.update', $tip) }}" method="post">
        @csrf
        @method('patch')
        <div>
          <div class="mt-2">
            <label for="name">タイトル</label>
            <input type="text" class="form-control mt-1" name="title" value="{{ old('title', $tip->title) }}">
          </div>
          <div class="mt-2">
            <label for="category_id">カテゴリー</label>
            <p>
              @foreach ($categories as $category)
                <span>{{ $category->name }}&nbsp;</span>
              @endforeach
            </p>
            <input type="text" class="form-control mt-1" name="category_id" value="{{ old('category_id', $tip->category_id) }}">
          </div>
          <div class="mt-2">
            <label for="content" style="display: block;">Tip詳細</label>
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
