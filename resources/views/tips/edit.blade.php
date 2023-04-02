@extends('layouts.app')

@section('content')
  <h1 class="modal-title" id="editTipModalLabel{{ $tip->id}}">Tipの編集</h1>

  </div>
    <form action="{{ route('tips.update', $tip) }}" method="post">
      @csrf
      @method('patch')
      <div class="modal-body">
        <div class="mb-2">
          <label for="name">タイトル</label>
          <input type="text" class="form-control mt-1" name="title" value="{{ $tip->title }}">
        </div>
        <div>
          <label for="category_id">カテゴリー</label>
          <input type="text" class="form-control mt-1" name="category_id" value="{{ $tip->category_id }}">
        </div>
        <div class="mt-2">
          <label for="content" style="display: block;">Tip詳細</label>
          <textarea class="ckeditor" name="content" cols="55" rows="10">{{ $tip->content }}</textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">更新</button>
        </div>
      </div>
    </form>
  </div>
@endsection
