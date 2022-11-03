  <div class="modal" id="edituserModal" tabindex="-1" aria-labelledby="edituserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="edit_users">
        <div class="modal-header">
          <h4>Редактирование пользователя</h4>
          <br>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
        </div>

        <div class="modal-body">
          <div class="tab-content">
            <div id="user_update" class="container tab-pane active">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="edit_user_name" class="col-form-label" required>Имя пользователя</label>
                    <input type="text" class="form-control" id="edit_user_name" name="edit_user_name" placeholder="Введите имя">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_user_login" class="col-form-label" required>Login</label>
                    <input type="text" class="form-control" id="edit_user_login" name="edit_user_login" placeholder="Login">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_user_pass" class="col-form-label">Password</label>
                    <input type="password" class="form-control" id="edit_user_pass" name="edit_user_pass" placeholder="Password">
                  </div>
                  <br>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_user_level_id" class="col-form-label">Тип пользователя</label>
                    <select class="form-select" id="edit_user_level_id" name="edit_user_level_id">
                      <option value="1">Admin</option>
                      <option value="2">Пользователь</option>
                      <option value="3">Наблюдатель</option>
                      <option value="4">Покупатель</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="edit_user_email" class="col-form-label">Email</label>
                    <input type="text" class="form-control" id="edit_user_email" name="edit_user_email" placeholder="@email">
                </div>
                </div>
                <div class="col-md-12">
                  <div class="form-check form-switch">
                 
                  <input class="form-check-input " type="checkbox" id="edit_user_enabled" name="edit_user_enabled" value="yes" checked>
                   <label for="edit_user_enabled" class="col-form-label">Доступ</label>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary" id="edit_user_button">Редактировать</button>
        </div>
      </div>
      <input type="hidden"  id="edit_user_id" name="edit_user_id"  value=""> 
     <!--  <input type="hidden"  id="edit_checkbox" name="edit_checkbox"  value="">  -->
</form>
