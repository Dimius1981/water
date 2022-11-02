<form action="" method="post">
  <div class="modal" id="usereditModal" tabindex="-1" aria-labelledby="usereditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Редактирование пользователя</h4>
          <br>
        </div>

        <div class="modal-body">
          <div class="tab-content">
            <div id="home" class="container tab-pane active">
              <div class="row">
                <div class="col-md-12">
                  <label for="user-name" class="col-form-label">Login</label>
                  <input type="text" class="form-control" id="user-login" name="login" placeholder="Example">
                </div>
                <div class="col-md-12">
                  <label for="user-par-id" class="col-form-label">Password</label>
                  <input type="text" class="form-control" id="user-password" name="password" placeholder="Example">
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
                  <input type="text" class="form-control" id="user-email" name="login" placeholder="Example@email">
                </div>
                <div class="col-md-6">

                  <label for="user-email" class="col-form-label">Доступ</label>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" value="yes" checked>
                  </div>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Отмена</button>
          <button type="submit" class="btn btn-primary">Редактировать</button>
        </div>
      </div>

    </div>
</form>
