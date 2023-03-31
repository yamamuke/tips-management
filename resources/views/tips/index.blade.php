@extends('layouts.app')

@section('content')
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

  </div>
@endsection
