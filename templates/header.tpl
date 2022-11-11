 <header>
    <nav class="navbar head">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"><h2>-=MSD=-</h2></a>
        <time>{$cur_time}</time>
        <div class="dropdown">
          <a class="btn navbar-brand dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            {$user_info.name}
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="/login.php?logout=true">Выход</a></li>
          </ul>
        </div>
    </div>
  </nav>
</header>

