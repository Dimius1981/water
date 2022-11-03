  <div class="modal" id="adduserModal" tabindex="-1" aria-labelledby="adduserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form class="add_users">
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
                  <div class="form-group">
                    <label for="add_user_name" class="col-form-label" required>Имя пользователя</label>
                    <input type="text" class="form-control" id="add_user_name" name="add_user_name" placeholder="Введите имя">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="add_user_login" class="col-form-label" required>Login</label>
                    <input type="text" class="form-control" id="add_user_login" name="add_user_login" placeholder="Login">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="add_user_pass" class="col-form-label">Password</label>
                    <input type="text" class="form-control" id="add_user_pass" name="add_user_pass" placeholder="Password">
                  </div>
                  <br>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="add_user_level_id" class="col-form-label">Тип пользователя</label>
                    <select class="form-select" id="add_user_level_id" name="add_user_level_id">
                      <option value="1">Admin</option>
                      <option value="2">Пользователь</option>
                      <option value="3">Наблюдатель</option>
                      <option value="4">Покупатель</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="add_user_email" class="col-form-label">Email</label>
                    <input type="text" class="form-control" id="add_user_email" name="add_user_email" placeholder="@email">
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
      </div>

    </div>
  </div>
