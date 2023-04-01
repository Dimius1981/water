<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10">
    <br>
    <div class="row">
      <div class="col-md-3">
        <h2>Журнал </h2>
      </div>
      <div class="col-md-9">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link " href="/">Home</a>
          </li>
          <li class="nav-item">
            {if $func_access[6]}
              <a class="nav-link" href="?page=downloads">Загрузка</a>
            {else}
              <a class="nav-link" href="#">Загрузка</a>
            {/if}
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Журнал</a>
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
    <hr>
    <div class="tab-content">

      <table class="table padd table-borderless">
        <thead class="table ">
          <tr>
            <th>Логин</th>
            <th>Имя</th>
            <th>Дата загрузки</th>
            <th>Файл</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Admin</td>
            <td>Admin</td>
            <td>11.11.2022 19:53:46</td>
            <td><a href="#">Excel1.xls</a></td>
          </tr>
          <tr>
            <td>Admin</td>
            <td>Admin</td>
            <td>11.11.2022 19:53:46</td>
            <td><a href="#">Excel1.xls</a></td>
          </tr>
          <tr>
            <td>Admin</td>
            <td>Admin</td>
            <td>11.11.2022 19:53:46</td>
            <td><a href="#">Excel1.xls</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-1">
  </div>
</div>