<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">カテゴリーの編集</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="" method="post" name="editCategoryForm">
        @csrf
        @method('patch')
        <div class="modal-body">
          <input type="text" class="form-control" name="name" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          <button type="submit" class="btn btn-primary">更新</button>
        </div>
      </form>
    </div>
  </div>
</div>
