<div class="row">
  <div class="col-md">
    <br>
    <div class="row">
      <div class="col-md-3">
        {if $func_access[1]}
          <h2>Датчики <button class="modaladdrec" data-bs-toggle="modal" data-bs-target="#addSensorsModal" ><img src="./templates/images/add.png"></button></h2>
        {else}
          <h2>Датчики <button class="modaladdrec"><img src="./templates/images/add.png"></button></h2>
        {/if}
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link active" href="/">Home</a>
              </li>
              <li class="nav-item">
                {if $func_access[6]}
                  <a class="nav-link" href="?page=downloads">Загрузка</a>
                {else}
                  <a class="nav-link" href="#">Загрузка</a>
                {/if}
              </li>
              <li class="nav-item">
                {if $func_access[7]}
                  <a class="nav-link" href="?page=logs">Журнал</a>
                {else}
                  <a class="nav-link" href="#">Журнал</a>
                {/if}
              </li>
              <li class="nav-item">
                {if $func_access[3]}
                  <a class="nav-link" href="?page=users">Пользователи</a>
                {else}
                  <a class="nav-link" href="#">Пользователи</a>
                {/if}
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        {if $func_access[5]}
          <button class="btn " data-bs-toggle="modal" data-bs-target="#addfileModal"><img src="templates/images/download.png"></button>
        {else}
          <button class="btn "><img src="templates/images/download.png"></button>
        {/if}
        <span>Загрузить файл</span>
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
      <tbody class="tbody_tablemain">
      </tbody>
    </table>
  </div>
</div>