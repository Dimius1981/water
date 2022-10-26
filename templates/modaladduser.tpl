<form action="/" method="post">
  <div class="modal" id="adduserModal" tabindex="-1" aria-labelledby="adduserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Добавление пользователя</h4>
          <br>
        </div>

        <div class="modal-body">
          <div class="tab-content">
            <div id="home" class="container tab-pane active">
              <div class="row">
                <div class="col-md-12">
                  <label for="user-name" class="col-form-label">Login</label>
                  <input type="text" class="form-control" id="user-login" name="login" placeholder="Login">
                </div>
                <div class="col-md-12">
                  <label for="user-par-id" class="col-form-label">Password</label>
                  <input type="text" class="form-control" id="user-password" name="password" placeholder="Password">
                  <br>
                </div>
                <div class="col-md-6">

                  <label for="user-status" class="col-form-label">Статус пользователя</label>
                  <select class="form-select">
                    <option>Admin</option>
                    <option>Пользователь</option>
                    <option>Наблюдатель</option>
                  </select>

                </div>
                <div class="col-md-6">

                  <label for="user-email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" id="user-email" name="login" placeholder="@email">
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Отмена</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </div>

    </div>
</form>