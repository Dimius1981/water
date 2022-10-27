<div class="modal fade" id="addSensorsModal" tabindex="-1" aria-labelledby="addSensorsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="add_sensors">
        <div class="modal-header">
          <h4>Добавить датчик</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="add_sensor_name" class="col-form-label">Имя</label>
                <input type="text" class="form-control" id="add_sensor_name" name="add_sensor_name" placeholder="Имя">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="add_sensor_number" class="col-form-label">Номер</label>
                <input type="number" class="form-control" id="add_sensor_number" name="add_sensor_number" placeholder="Номер" min="1">
              </div>
            </div>

            <!--<div class="col-md-5">
              <div class="form-group">
                <label for="add_sensor_model" class="col-form-label">Модель</label>
                <select class="form-control" id="add_sensor_model" name="add_sensor_model">
                  <option value="1">МСД-1</option>
                  <option value="2">ДУВ-2</option>
                </select>
              </div>
            </div>-->

            <div class="col-md-12">
              <div class="form-group">
                <label for="add_sensor_description" class="col-form-label">Описание датчика</label>
                <textarea class="form-control" id="add_sensor_description" rows="3" name="add_sensor_description" placeholder="Описание датчика"></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="add_sensor_phone" class="col-form-label">Телефон</label>
                <input type="text" class="form-control" id="add_sensor_phone" name="add_sensor_phone" placeholder="Телефон">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="add_sensor_seth" class="col-form-label">Высота от датчика, см</label>
                <input type="number" class="form-control" id="add_sensor_seth" name="add_sensor_seth" placeholder="Высота от датчика, см">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
      </form>
    </div>

  </div>
</div>