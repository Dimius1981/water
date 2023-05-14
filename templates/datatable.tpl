<div class="row">
  <div class="col-md">
    <br>
    <div class="row">
      <div class="col-md-3">
        <h2>
          <a href="/"><img src="./templates/images/arrow-left.png"></a> {$sensor_info.name}
        </h2>
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
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#home">Данные таблиц</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu1">График</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu2">Итог</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active mr3"><br>
     <table class="table ">
          <thead class="table">
            <tr>
              <th>ID</th>
              <th>Уровень, см.</th>
              <th>Расход, м<sup>3</sup></th>
              <th>Дата и время</th>
              <th>Заряд акк.</th>
            </tr>
          </thead>
          <tbody>
            {foreach $listrec as $item}
            <tr>
              <td>{$item.id}</td>
              <td>{$item.new_level}</td>
              <td>{$item.new_rashod}</td>
              <td>{$item.date_insert}</td>
              <td>{$item.bat}</td>
            </tr>
            {/foreach}
          </tbody>
        </table>

<nav aria-label="Навигация по страницам">
  <ul class="pagination justify-content-center">
    {if $prev_page < 0}
      <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Предыдущая</a></li>
    {else}
      <li class="page-item"><a class="page-link" href="/?page=datatable&sens_id={$sensor_info.id}&start={$prev_page}&count=30">Предыдущая</a></li>
    {/if}
    {$page_count = 1}
    {foreach $pagination as $item}
      {if $item == $start}
        <li class="page-item active" aria-current="page"><a class="page-link" href="/?page=datatable&sens_id={$sensor_info.id}&start={$item}&count=30">{$page_count}</a></li>
      {else}
        <li class="page-item"><a class="page-link" href="/?page=datatable&sens_id={$sensor_info.id}&start={$item}&count=30">{$page_count}</a></li>
      {/if}
      {$page_count = $page_count + 1}
    {/foreach}
    {if $next_page < 0}
      <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Следующая</a></li>
    {else}
      <li class="page-item"><a class="page-link" href="/?page=datatable&sens_id={$sensor_info.id}&start={$next_page}&count=30">Следующая</a></li>
    {/if}
  </ul>
</nav>

    </div>
    <div id="menu1" class="container tab-pane fade mr3"><br>
      <img src="./templates/html/table/graph.png">
    </div>
    <div id="menu2" class="container tab-pane fade mr3"><br>
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
  </div>

  </div>
</div>