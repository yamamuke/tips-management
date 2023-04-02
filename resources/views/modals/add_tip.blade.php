<div class="modal fade" id="addTipModal" tabindex="-1" aria-labelledby="addTipModaLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTipModalLabel">Tipの追加</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="{{ route('tips.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-2">
            <label for="name">タイトル</label>
            <input type="text" class="form-control mt-1" name="title">
          </div>
          <div>
            <label for="category_id">カテゴリー</label>
            <input type="text" class="form-control mt-1" name="category_id">
          </div>
          <div class="mt-2">
            <label for="content" style="display: block;">Tip詳細</label>
            <textarea class="ckeditor" name="content" cols="55" rows="10"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">登録</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
