<div class="modal fade" id="deleteTipModal{{ $tip->id }}" tabindex="-1" aria-labelledby="deleteTipModalLabel{{ $tip->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTipModalLabel{{ $tip->id }}">「{{ $tip->title }}」を削除してもよろしいですか？</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
      </div>
      <div class="modal-footer">
        <form action="{{ route('tips.destroy', $tip) }}" method="post">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
  </div>
</div>
