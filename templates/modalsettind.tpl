<form action="/" method="post">
  <div class="modal" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4>Настройки</h4>
          <br>
          <!-- Nav pills -->
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="pill" href="#home">Настройки</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="pill" href="#menu1">Таблица</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="pill" href="#menu2">Журнал</a>
            </li>
          </ul>

        </div>

        <div class="modal-body">
          <div class="modal-body">
            <div class="tab-content">
              <div id="home" class="container tab-pane active">

                <div class="row">
                  <div class="col-md-6">
                    <label for="user-name" class="col-form-label">Имя</label>
                    <input type="text" class="form-control" id="user-name" name="login" placeholder="Имя">
                  </div>
                  <div class="col-md-6">
                    <label for="user-par-id" class="col-form-label">Номер</label>
                    <input type="text" class="form-control" id="user-name" name="login" placeholder="Номер">
                  </div>
                  <div class="col-md-12">
                    <label for="user-description" class="col-form-label">Описание группы</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
                  <div class="col-md-6">
                    <label for="user-name" class="col-form-label">Телефон</label>
                    <input type="text" class="form-control" id="user-name" name="login" placeholder="Телефон">
                  </div>
                  <div class="col-md-6">
                    <label for="user-par-id" class="col-form-label">Высота</label>
                    <input type="text" class="form-control" id="user-name" name="login" placeholder="Высота">
                  </div>
                </div>
              </div>
              <div id="menu1" class="container tab-pane fade">
                <div class="btn-group">
                <button type="button" class="btn btn-success">Добавить</button>
                <button type="button" class="btn btn-danger">Удалить</button>
                <button type="button" class="btn btn-secondary">Изменить</button>
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th>№</th>
                      <th>Уровень (см)</th>
                      <th>Расход (м3)</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td> 
                     <td> <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                      <label class="form-check-label"></label>
                    </div>
                    </td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td>
                      <td> <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                      <label class="form-check-label"></label>
                    </div>
                    </td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>0</td>
                      <td>0</td>
                      <td> <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                      <label class="form-check-label"></label>

                    </div>
                    </td>

                    </tr>
                    <button type="button" class="btn btn-light">Очистить</button>
                  </tbody>
                </table>
              </div>
              <div id="menu2" class="container tab-pane fade">
                <label for="user-description" class="col-form-label">Информация</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Connect...."></textarea>

              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary mr1">Отмена</button>
          <button type="submit" class="btn btn-primary">Обновить</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </div>

    </div>
</form>