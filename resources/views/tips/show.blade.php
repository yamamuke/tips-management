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

      <h1 class="modal-title" id="editTipModalLabel{{ $tip->id}}">Tipの詳細</h1>
      
      <div class="mb-2">
        <label class="my-3" style="font-weight: bold;" for="name">タイトル</label>
        <p>{{ $tip->title }}</p>
      </div>
      <div>
        <label class="my-3" style="font-weight: bold; for="category">カテゴリー</label>
        {{-- @foreach ($categories as $category)
          <p>{{ $category->name }}</p>
        @endforeach --}}
      </div>
      <div class="mt-2">
        <label for="content" style="display: block;">Tip詳細</label>
        <textarea class="ckeditor" name="content" cols="55" rows="10">{{ $tip->content }}</textarea>
      </div>
    </div>
  </article>
@endsection
