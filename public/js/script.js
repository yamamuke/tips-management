// カテゴリーの編集用フォーム
const editCategoryForm = document.forms.editCategoryForm;

// カテゴリーの削除用フォーム
const deleteCategoryForm = document.forms.deleteCategoryForm;

// 削除の確認メッセージ
const deleteMessage = document.getElementById('deleteCategoryModalLabel');

// カテゴリーの編集用モーダルを開くときの処理
document.getElementById('editCategoryModal').addEventListener('show.bs.modal', (event) => {
  let categoryButton = event.relatedTarget;
  let categoryId = categoryButton.dataset.categoryId;
  let categoryName = categoryButton.dataset.categoryName;

  editCategoryForm.action = `categories/${categoryId}`;
  editCategoryForm.name.value = categoryName;
});

// カテゴリーの削除用モーダルを開くときの処理
document.getElementById('deleteCategoryModal').addEventListener('show.bs.modal', (event) => {
  let deleteButton = event.relatedTarget;
  let tagId = deleteButton.dataset.categoryId;
  let categoryName = deleteButton.dataset.categoryName;

  deleteCategoryForm.action = `categories/${categoryId}`;
  deleteMessage.textContent = `「${categoryName}」を削除してよろしいですか？`;
});
