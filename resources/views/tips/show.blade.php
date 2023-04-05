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

      <!-- Tipの削除用モーダル -->
      @include('modals.delete_tip', $tip)

      <div class="d-flex">
        <h1 class="modal-title" id="editTipModalLabel{{ $tip->id}}">Tipの詳細</h1>
        <a href="{{ route('tips.edit', $tip) }}"><img src="{{ asset('storage/edit.png') }}" alt="編集" class="ms-3" style="height:1.5rem; vertical-align:-100%;"></a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteTipModal{{ $tip->id }}"><img src="{{ asset('storage/delete.png') }}" alt="削除" style="height:1.5rem; vertical-align:-100%;" class="ms-3"></a>
      </div>

      <div>
        <a href="{{ route('tips.index') }}">トップに戻る</a>
      </div>

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
