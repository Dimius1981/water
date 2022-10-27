<div class="row">
  <div class="col-md">
    <br>
    <div class="row">
      <div class="col-md-3">
        <h2>Датчики <button class="modaladdrec" data-bs-toggle="modal" data-bs-target="#addSensorsModal" ><img src="./templates/images/add.png"></button></h2>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=downloads">Загрузка</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=logs">Журнал</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=users">Пользователи</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane container active" id="home"></div>
              <div class="tab-pane container fade" id="menu1"></div>
              <div class="tab-pane container fade" id="menu2"></div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="example-3">
          <label for="custom-file-upload" class="filupp">
            <span class="filupp-file-name js-value">Загрузить файл</span>
            <input type="file" name="attachment-file" value="1" id="custom-file-upload">
          </label>
        </div>

      </div>
    </div>

    <hr>
    <table class="table ">
      <thead class="table">
        <tr>
          <th>Номер</th>
          <th>Имя</th>
          <th>Уровень, см</th>
          <th>Расход воды, м<sup>3</sup></th>
          <th>Сумм. расход, м<sup>3</sup></th>
          <th>Заряд батареи</th>
          <th>Дата обновления</th>
          <th>Время работы</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        {foreach $sensors_list as $item}
        <tr class="{$item.row_style}">
          <td align="center">{$item.factorynumber}</td>
          <td>{$item.name}</td>
          <td>{$item.last_level}</td>
          <td>{$item.last_rashod}</td>
          <td>7777777</td>
          <td>{$item.last_bat}</td>
          <td>{$item.last_date}</td>
          <td>{$item.sensor_date_live}</td>
          <td>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#setSensorsModal"><img src="templates/image/setting.png"></button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delSensorsModal"><img src="templates/image/del.png"></button>
          </td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>