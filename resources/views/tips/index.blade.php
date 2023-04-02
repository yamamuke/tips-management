@extends('layouts.app')

@section('content')
  <article class="tips">
    <h1 style="text-align: center;">Tipsリスト</h1>
    <div class=tips-ui">
      <div>
        <!-- ここに検索ボックスを作成する -->
      </div>
    </div>

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

      <!-- Tipの追加用モーダル -->
      @include('modals.add_tip')

      <!-- Categoryの追加用モーダル -->
      @include('modals.add_category')

      <div class="d-flex mb-3">
        <a href="#" class="link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addTipModal">
          <div class="d-flex align-items-center">
            <span class="fs-5 fw-bold">＋</span>&nbsp;Tipの追加
          </div>
        </a>
        <a href="#" class="ms-4 link-dark text-decoration-none" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
          <div class="d-flex align-items-center">
            <span class="fs-5 fw-bold">＋</span>&nbsp;カテゴリーの追加
          </div>
        </a>
      </div>

      <table class="tips-table">
        <tr>
          <th>タイトル</th>
          <th>更新日時</th>
          <th>カテゴリー</th>
          <th>編集</th>
          <th>削除</th>
          <td></td>
        </tr>

        @foreach ($tips as $tip)

          <!-- Tipの編集用モーダル -->
          @include('modals.edit_tip')

          <!-- Tipの削除用モーダル -->
          @include('modals.delete_tip')
          
          <tr>
            <td><a href="#">{{ $tip->title }}></a></td>
            <td>{{ $tip->updated_at }}</td>
            <td>{{ $tip->category_id }}</td>
            <!-- <td><button><a href="#" data-bs-toggle="modal" data-bs-target="#editTipModal{{ $tip->id }}">編集</a></button></td> -->
            <td><button><a href="{{ route('tips.edit', $tip) }}">編集</a></button></td>
            <td><button><a href="#" data-bs-toggle="modal" data-bs-target="#deleteTipModal{{ $tip->id }}"> 削除</a></button></td>
            <tr>
              <td>
                <p>{{ strip_tags(mb_substr($tip->content, 0, 150)); }}&nbsp;...</p>
              </td>
            </tr>
          </tr>
        @endforeach
      </table>
    </div>
  </article>
@endsection
