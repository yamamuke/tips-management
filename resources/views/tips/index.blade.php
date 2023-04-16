@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('/js/script.js') }}"></script>
@endpush

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

      <!-- Categoryの追加用モーダル -->
      @include('modals.add_category')

      <div class="d-flex mb-3">
        <a href="{{ route('tips.create') }}" class="link-dark text-decoration-none">
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
          <th class="display-date">更新日時</th>
          <th colspan="2"></th>
        </tr>

        @foreach ($tips as $tip)

          <!-- Tipの削除用モーダル -->
          @include('modals.delete_tip', $tip)

          <tr>
            <td style="text-align: left;">
              <div class="d-flex flex-wrap mb-1">
                @foreach ($tip->categories()->orderBy('name', 'asc')->get() as $category)
                  <span class="badge bg-secondary me-2 mb-1 fw-light">{{ $category->name }}</span>
                @endforeach
              </div>
              <p class="title w-100">{{ $tip->title }}</p>
              <p class="w-100">{{ strip_tags(mb_substr($tip->content, 0, 120)); }}&nbsp;...</p>
              <div>
                <a href="{{ route('tips.show', $tip) }}">詳細</a>
              </div>
            </td>
            <td class="display-date">{{ date_format($tip->updated_at, 'Y/m/d H:i') }}</td>
            <td><a href="{{ route('tips.edit', $tip) }}"><img src="{{ asset('storage/edit.png') }}" alt="編集" class="img"></a></td>
            <td><a href="#" data-bs-toggle="modal" data-bs-target="#deleteTipModal{{ $tip->id }}"><img src="{{ asset('storage/delete.png') }}" alt="削除" class="img"></a></td>
          </tr>
        @endforeach
      </table>
    </div>
  </article>
@endsection
