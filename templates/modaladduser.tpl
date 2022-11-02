
  <div class="modal" id="adduserModal" tabindex="-1" aria-labelledby="adduserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Добавление пользователя</h4>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          <br>
        </div>

        <div class="modal-body">
          <div class="tab-content">
            <div id="home" class="container tab-pane active">
              <div class="row">
                <div class="col-md-12">
                  <label for="user-name" class="col-form-label" required>Login</label>
                  <input type="text" class="form-control" id="add_user_login" name="login" placeholder="Login">
                </div>
                <div class="col-md-12">
                  <label for="user-par-id" class="col-form-label">Password</label>
                  <input type="text" class="form-control" id="add_user_pass" name="password" placeholder="Password">
                  <br>
                </div>
                <div class="col-md-6">

                  <label for="user-status" class="col-form-label">Статус пользователя</label>
                  <select class="form-select" id="add_user_level_id">
                    <option value="1">Admin</option>
                    <option value="2">Пользователь</option>
                    <option value="3">Наблюдатель</option>
                  </select>

                </div>
                <div class="col-md-6">

                  <label for="user-email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" id="add_user_email" name="login" placeholder="@email">
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary" id="btnAddUser">Сохранить</button>
        </div>
      </div>

    </div>
  </div>
