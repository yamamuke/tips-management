<!-- カテゴリーの編集用モーダル -->
@include('modals.edit_category')

<!-- カテゴリーの削除用モーダル -->
@include('modals.delete_category')

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">カテゴリーの追加</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="text" class="form-control" name="name">
          <div class="d-flex flex-wrap">
            @foreach ($categories as $category)
              <div class="d-flex align-items-center mt-2 ms-3 mb-1">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-bs-dismiss="modal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">{{ $category->name }}</button>
                <button type="button" class="btn-close ms-1" aria-label="削除" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-bs-dismiss="modal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}"></button>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>
