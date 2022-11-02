<div class="modal" id="setSensorsModal" tabindex="-1" aria-labelledby="setSensorsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="set_sensors">
        <div class="modal-header">
          <h4>Настройки</h4>
          <!-- Nav pills -->
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" href="#sens_settings">Настройки</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#sens_table">Таблица</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#sens_log">Журнал</a>
              </li>
            </ul>
        </div>

        <div class="modal-body">
          <div class="tab-content">
            <div id="sens_settings" class="tab-pane fade show active">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="set_sensor_name" class="col-form-label">Имя</label>
                    <input type="text" class="form-control" id="set_sensor_name" name="set_sensor_name" placeholder="Имя">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="set_sensor_number" class="col-form-label">Номер</label>
                    <input type="text" class="form-control" id="set_sensor_number" name="set_sensor_number" placeholder="Номер" readonly>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="set_sensor_description" class="col-form-label">Описание датчика</label>
                    <textarea class="form-control" id="set_sensor_description" name="set_sensor_description" rows="3"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="set_sensor_phone" class="col-form-label">Телефон</label>
                    <input type="text" class="form-control" id="set_sensor_phone" name="set_sensor_phone" placeholder="Телефон">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="set_sensor_seth" class="col-form-label">Высота от датчика, см</label>
                    <input type="number" class="form-control" id="set_sensor_seth" name="set_sensor_seth" placeholder="Высота от датчика, см">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="set_sensor_start" class="col-form-label">В работе с:</label>
                    <input type="date" class="form-control" id="set_sensor_start" name="set_sensor_start">
                  </div>
                </div>
              </div>
            </div>
            <div id="sens_table" class="tab-pane fade">
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
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                        <label class="form-check-label"></label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                        <label class="form-check-label"></label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something">
                        <label class="form-check-label"></label>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <button type="button" class="btn btn-light">Очистить</button>
            </div>
            <div id="sens_log" class="tab-pane fade">
              <label for="user-description" class="col-form-label">Информация</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Connect...."></textarea>
            </div>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger me-auto" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
  </div>
</div>
