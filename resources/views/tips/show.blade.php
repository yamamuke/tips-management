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
        <h1 class="fs-2">Tipの詳細</h1>
        <a href="{{ route('tips.edit', $tip) }}"><img src="{{ asset('storage/edit.png') }}" alt="編集" class="img ms-3"></a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteTipModal{{ $tip->id }}"><img src="{{ asset('storage/delete.png') }}" alt="削除" class="img ms-3"></a>
      </div>

      <div class="mt-3">
        <a href="{{ route('tips.index') }}">&lt;トップに戻る</a>
      </div>

      <div class="mt-3">
        <label class="my-2 fw-bold" for="name">タイトル</label>
        <p>{{ $tip->title }}</p>
      </div>
      <div>
        <label class="my-2 fw-bold" for="category">カテゴリー</label>
        <div class="d-flex flex-wrap">
          @foreach ($tip->categories()->orderBy('name', 'asc')->get() as $category)
            <label>
              <div class="d-flex align-items-center mt-1 me-2">
                <span class="badge bg-secondary fw-light">{{ $category->name }}</span>
              </div>
            </label>
          @endforeach
        </div>
      </div>
      <div class="mt-4">
        <label for="content" class="mb-2" style="display: block;">Tip詳細</label>
        <textarea id="ckeditor2" name="content">{{ $tip->content }}</textarea>
      </div>
      <!-- public/ckeditor/ckeditor.jsを呼び出してid=ckeditor2に適用 -->
      <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
      <script type="text/javascript">CKEDITOR.replace( 'ckeditor2' );</script>
    </div>
  </article>
@endsection
