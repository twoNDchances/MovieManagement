<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Movies</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- Template jQuery File -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
        <img src="/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ $email }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ $email }}</h6>
              <span>{{ $name }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profile') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Managements</li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('movies.page') }}">
          <i class="bi bi-tv"></i>
          <span>Movies</span>
        </a>
      </li><!-- End Movies Nav -->

      <li class="nav-heading">Categories</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('genres.page') }}">
          <i class="bi bi-tags"></i>
          <span>Genres</span>
        </a>
      </li><!-- End Genres Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('regions.page') }}">
          <i class="bi bi-globe"></i>
          <span>Regions</span>
        </a>
      </li><!-- End Regions Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('actors.page') }}">
          <i class="bi bi-person-lines-fill"></i>
          <span>Actors</span>
        </a>
      </li><!-- End Actors Nav -->

      <li class="nav-heading">Permissions</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('users.page') }}">
          <i class="bi bi-people"></i>
          <span>Users</span>
        </a>
      </li><!-- End Users Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Movies</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="{{ route('movies.page') }}">Movies</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <a type="button" class="btn btn-primary mt-4 mb-4" href="{{ route('movies.add') }}">
            <i class="bi bi-plus-circle"></i>
            <span>Add Movie</span>
            </a>
              <!-- Table with stripped rows -->
               <div id="moviesListHolder"></div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

  <!-- Template Custom JS File -->

  <script>
    $(document).ready(function () {
      callAPI(
        'get',
        '{{ route("movies.list") }}',
        function () {
          $('#moviesListHolder').append(`
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          `)
        },
        function (data) {
          let responseData = JSON.parse(data.responseText)
          if (responseData.movies.length == 0) {
            $('#moviesListHolder').empty().append(`
              <h1 class="text-center">Empty</h1>
            `)
          } else {
            $('#moviesListHolder').empty().append(`
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Informations</th>
                    <th>Release Year</th>
                    <th>Poster</th>
                  </tr>
                </thead>
                <tbody id="moviesList">
                </tbody>
              </table>
            `)
            for (let index = 0; index < responseData.movies.length; index++) {
              const element = responseData.movies[index];
              $('#moviesList').append(`
                <tr>
                  <td>Unity Pugh</td>
                  <td>9958</td>
                  <td>Curicó</td>
                </tr>
              `)
            }
          }
        },
        function (error) {
          if (error.status == 403) {
            $('#moviesListHolder').empty().append(`
              <h1 class="text-center">Permission denied</h1>
            `)
            return
          }
        }
      )
    })
    function callAPI(method, endpoint, onLoading, onSuccess, onError, body = null) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 0 || this.readyState == 1 || this.readyState == 2 || this.readyState == 3) {
                onLoading()
            }
            else if (this.readyState == 4 && this.status == 200) {
                onSuccess(this)
            }
            else if (this.status != 200) {
                onError(this)
            }
        }
        xhr.open(String(method).toUpperCase(), endpoint);
        xhr.setRequestHeader('Content-Type', 'application/json')
        xhr.timeout = 5000
        if (body == null) {
            xhr.send();
        }
        else {
            xhr.send(body);
        }
    }
  </script>

</body>

</html>