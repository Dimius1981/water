<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10">
    <br>
    <div class="row">
      <div class="col-md-4">
        <h2>Пользователи <button class="modaladdrec" data-bs-toggle="modal" data-bs-target="#adduserModal" ><img src="./templates/images/adduser.png"></button></h2>
      </div>
      <div class="col-md-8">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=downloads">Загрузка</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=logs">Журнал</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="?page=users">Пользователи</a>
          </li>
        </ul>
      </div>
      <hr>
      <div class="tab-content">

        <table class="table padd table-borderless">
          <thead class="table ">
            <tr>
              <th>Статус</th>
              <th>Имя</th>
              <th>Логин</th>
              <th>Последний сеанс</th>
              <th>email</th>
              <th>Доступ</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            {foreach $userlist_arr as $item}
            <tr>
              <td>{$item.level_id}</td>
              <td>{$item.name}</td>
              <td>{$item.login}</td>
              <td>{$item.date_login}</td>
              <td>{$item.email}</td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" value="yes" checked>
                </div>
              </td>
              <td>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#usereditModal"><img src="templates/images/pen.png"></button>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deluserModal" data-user-id="{$item.id}" data-user-name="{$item.name}" id="btndeleteuser"><img src="templates/images/del.png"></button>
              </td>
            </tr>
            {/foreach}
            
          </tbody>
        </table> 
      </div>
    </div>
  </div>
  <div class="col-md-1">
  </div>
</div>