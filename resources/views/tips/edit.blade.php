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

      <form action="{{ route('tips.update', $tip) }}" method="post">
        @csrf
        @method('patch')
        <div>
          <div class="mt-2">
            <label for="name">タイトル</label>
            <input type="text" class="form-control mt-1" name="title" value="{{ $tip->title }}">
          </div>
          <div class="mt-2">
            <label for="category_id">カテゴリー</label>
            <input type="text" class="form-control mt-1" name="category_id" value="{{ $tip->category_id }}">
          </div>
          <div class="mt-2">
            <label for="content" style="display: block;">Tip詳細</label>
            <textarea class="ckeditor" name="content" cols="55" rows="10">{{ $tip->content }}</textarea>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary">更新</button>
          </div>
        </div>
      </form>
    </div>
  </article>
@endsection
