<div class="modal fade" id="editTipModal{{ $tip->id }}" tabinex="-1" aria-labelledby="editTipModalLabel{{ $tip->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTipModalLabel{{ $tip->id}}">Tipの編集</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <form action="{{ route('tips.update', $tip) }}" method="post">
        @csrf
        @method('patch')
        <div class="modal-body">
          <input type="text" class="form-control" name="title" value="{{ $tip->title }}">
          <textarea id="ckeditor" naame="content" col="55" rows="10"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">更新</button>
        </div>
      </form>
    </div>
  </div>
</div>

