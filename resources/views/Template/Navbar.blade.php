<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="" id="navbarNav">
            <ul class="navbar-nav" id="leftNav">
                <li class="nav-item">
                  <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                </li>
                <li class="nav-item">
                  <div class="logo">
                    <img src="/theme/assets/images/logo244.png" width="40px" alt="">
                  </div>
                </li>
                <li class="nav-item">
                  <li class="nav-item">
                      <a class="nav-link">S i m e l a j a n g</a>
                  </li>
                </li>
                {{-- <li class="nav-item">
                  <a class="nav-link" href="#">Help</a>
                </li> --}}
            </ul>
        </div>
        <div>
          <!-- <li class="nav-item">
            <a class="nav-link">Hai {{ $userx->fullname }} ({{ $userx->role }}) Selamat Datang ...</a>
          </li> -->
          {{-- <li class="nav-item dropdown">
              <a class="nav-link search-dropdown" href="#" id="searchDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="search"></i></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-lg search-drop-menu" aria-labelledby="searchDropDown">
                <form>
                  <input class="form-control" type="text" placeholder="Type something.." aria-label="Search">
                </form>
                <h6 class="dropdown-header">Recent Searches</h6>
                <a class="dropdown-item" href="#">charts</a>
                <a class="dropdown-item" href="#">new orders</a>
                <a class="dropdown-item" href="#">file manager</a>
                <a class="dropdown-item" href="#">new users</a>
              </div>
            </li> --}}
        </div>
        <div class="" id="headerNav">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <font size="2"><a style="float: right;">Pemerintah Kota Palu</a></font><br>
              <font size="2"><a style="float: right;"></a>{{ $opd->nama_opd }}</font><br>
              {{-- <font size="2"><a style="text-align: center;">Mohammad Iful</a></font> --}}
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="/theme/assets/images/133.png" alt=""></a>
              <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                <a class="dropdown-item" href="#"><i data-feather="user"></i>Profile</a>
                <a class="dropdown-item" href="#"><i data-feather="settings"></i>Settings</a>
                <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i>Logout</a>
              </div>
            </li>
          </ul>
      </div>
    </nav>
</div>