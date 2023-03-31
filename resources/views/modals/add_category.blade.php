<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryLabel">カテゴリーの追加</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="text class="form-control" name="name">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </form>
    </div>
  </div>
</div>
