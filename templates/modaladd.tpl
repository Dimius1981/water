<form action="/" method="post">
  <div class="modal" id="addSensorsModal" tabindex="-1" aria-labelledby="addSensorsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Добавить датчик</h4>
          <br>
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
                    <label for="user-description" class="col-form-label">Описание датчика</label>
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
                <table class="table">
                  <thead>
                    <tr>
                      <th>Дата</th>
                      <th>Расход</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>22.12.2022</td>
                      <td>77777</td>

                    </tr>
                    <tr>
                      <td>22.12.2022</td>
                      <td>77777</td>
                    </tr>
                    <tr>
                      <td>22.12.2022</td>
                      <td>77777</td>
                    </tr>
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
          <button type="submit" class="btn btn-danger ">Отмена</button>
          <button type="submit" class="btn btn-primary">Добавить</button> 
        </div>
      </div>

    </div>
</form>