@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('/js/script.js') }}"></script>
@endpush

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

      <div class="d-flex justify-content-center">
        <a href="{{ route('tips.index') }}" class="text-decoration-none">
          <h1>Tipsリスト</h1>
        </a>
      </div>

      <!-- Categoryの追加用モーダル -->
      @include('modals.add_category')

      <div class="d-flex mb-3 mx-auto">
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
        <!-- カテゴリー検索ボックス -->
        <div class="ms-auto">
          <form action="{{ route('tips.index') }}" method="get">
            <input type="hidden" name="sort" value="{{ $sort }}">
            <select class="me-1" name="selected_category" required>
              <option hidden selected disabled value="">&#xf02d; カテゴリー検索</option>
              @foreach ($ctgry_collection as $category)
                <option value="{{ $category->id }}" class="option-valid">{{ $category->name }}</option>
              @endforeach
            </select>
            <input type="submit" name="submit" value="検索" />
          </form>
        </div>
      </div>
      <div class="d-flex justify-content-center align-items-center position-relative">
        <!-- キーワード検索ボックス -->
        <div class="justify-content-start position-absolute start-0">
          <form action="{{ route('tips.index') }}" method="get">
            <input type="text" class="search-box" placeholder="&#xf002; キーワード検索" name="keyword" value="{{ $keyword }}">
          </form>
        </div>
        <!-- 並び替えボタン -->
        <div class="my-3">
          <a href="{{ route('tips.index', [
              'sort' => 'asc', 'keyword' => $keyword, 'selected_category' => $selected_category
            ]) }}" class="sort-btn m-1">更新日時順（昇順）</a>
          <a href="{{ route('tips.index', [
              'sort' => 'desc', 'keyword' => $keyword, 'selected_category' => $selected_category
            ]) }}" class="sort-btn m-1">更新日時順（降順）</a>
        </div>
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
