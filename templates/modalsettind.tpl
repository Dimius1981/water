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
                <button type="button" class="btn btn-success" id="btn_table_add">Добавить</button>
                <button type="button" class="btn btn-danger" id="btn_table_del">Удалить</button>
                <button type="button" class="btn btn-light" id="btn_table_clear">Очистить</button>
              </div>

              <div class="scroll_table">
              <table class="table" id="settings_table">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tbl_sel_all">
                      </div>
                    </th>
                    <th>№</th>
                    <th>Уровень (см)</th>
                    <th>Расход (м3)</th>
                  </tr>
                </thead>
                <tbody id="settings_table_body">
                  <tr class="trow">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="cb_row" value="1">
                      </div>
                    </td>
                    <td><span class="num_rec">1</span></td>
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control level_num" name="level_num_row[]">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <input type="number" class="form-control rashod_num" name="rashod_num_row[]">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              </div>
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
        <input type="hidden" name="iseditsettings" value="0">
        <input type="hidden" name="isedittable" value="0">
      </form>
    </div>
  </div>
</div>
