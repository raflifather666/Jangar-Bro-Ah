<x-app-layout>
    <!doctype html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Dashboard Admin</title>
      <link rel="shortcut icon" type="image/png" href="../asset/images/logos/favicon.png" />
      <link rel="stylesheet" href="../asset/css/styles.min.css" />
    </head>

    <body>
      <!--  Body Wrapper -->
      <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
          <!-- Sidebar scroll-->
          <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
              <a href="./index.html" class="text-nowrap logo-img">
                <img src="../asset/images/logos/dark-logo.svg" width="180" alt="" />
              </a>
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
              </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                  <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                  <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="/menu" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Menu</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="/chefs" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Chefs</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="/kontak-tables" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Advices</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="/reservation" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Reservasi</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="/gallery" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Gallery</span>
                  </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">CRUD</span>
                  </li>
            </nav>
            <!-- End Sidebar navigation -->
          </div>
          <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
          <!--  Header Start -->
          <header class="app-header">

          </header>
          <!--  Header End -->
          <div class="container-fluid px-2 px-md-4">
      <div class="card card-body mx-3 mx-md-4 mt-1">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <div>
                          <a href="{{ route('menu.create') }}" class="btn btn-dark">
                              <i class="fa-solid fa-plus"></i> New
                          </a>
                      </div>
                  </div>
            
                  {{-- Tampilkan pesan sukses atau error, jika ada. --}}
                  @if (Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      <b>{{ Session::get('success') }}</b>
                  </div>
                  @elseif (Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                      <b>{{ Session::get('error') }}</b>
                  </div>
                  @endif
            
                  <hr>
            
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Gambar</th>
                              <th>Menu</th>
                              <th>Harga</th>
                              <th>Deskripsi</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($menu as $n)
                          <tr>
                              <td>
                                  <img src='{{ asset("menu-images/$n->image") }}' class="img-thumbnail" style="max-width: 25vw" 
                                  alt="image">
                              </td>
                              <td>{{ $n->menu }}</td>
                              <td>{{ Str::limit($n->harga) }}</td>
                              <td>{{ Str::limit($n->deskripsi) }}</td>
                              <td>
                                  <a href="{{ route('menu.edit', $n->id) }}" class="btn btn-warning">
                                      <i class="fa-solid fa-edit"></i>Edit
                                  </a>
                                  <button class="btn btn-danger" onclick="handleDelete({{ $n->id }})">
                                      <i class="fa-solid fa-trash"></i> Delete
                                  </button>
                                  <form action="{{ route('menu.destroy', $n->id) }}" method="POST" id ="form-delete-{{ $n->id }}">
                                      @csrf
                                      @method('DELETE')
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
            
            
            </div>
            <script>
              const handleDelete = (id) => {
                  if (confirm('Hapus data ini?')) {
                      document.getElementById(`form-delete-${id}`).submit();
                  }
              } 
            </script> 
        </div>
      </div>
    </div>
        </div>
      </div>
      <script src="../asset/libs/jquery/dist/jquery.min.js"></script>
      <script src="../asset/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/js/sidebarmenu.js"></script>
      <script src="../asset/js/app.min.js"></script>
      <script src="../asset/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="../asset/libs/simplebar/dist/simplebar.js"></script>
      <script src="../asset/js/dashboard.js"></script>
    </body>

    </html>
</x-app-layout>
