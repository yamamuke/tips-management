<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCategoryModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-toggle="modal" aria-label="閉じる"></button>
      </div>
      <div class="modal-footer">
        <form action="" method="post" name="deleteCategoryForm">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
