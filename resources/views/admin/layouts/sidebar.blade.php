

<link rel="stylesheet" href="/assets/css/admin.css">

<header id="navbar" class="navbar navbar-dark sticky-top shadow" style="background-color: #09165c">
    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="50px" class="mx-2">
    <a class="navbar-brand me-auto px-2 m-0" style="background-color: #09165c" href="/dashboard ">Admin Trace Study</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-5 text-white" href="{{ route('logout') }}">Sign out</a>
      </div>
    </div>
  </header>
  
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Status Alumni
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/kondisi-alumni/Bekerja(Pegawai)">Bekerja</a></li>
                <li><a class="dropdown-item" href="/kondisi-alumni/Berwirausaha">Wirausaha</a></li>
                <li><a class="dropdown-item" href="/kondisi-alumni/Melanjutkan Kuliah">Kuliah</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Jurusan Alumni
              </a>
              <ul class="dropdown-menu">
                <x-data-jurusan/>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Data Jurusan
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('view-jurusan') }}">Lihat Jurusan</a></li>
                <li><a class="dropdown-item" href="{{ route('add-jurusan') }}">Tambah Jurusan</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
