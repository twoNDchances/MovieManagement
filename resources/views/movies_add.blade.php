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
          <li class="breadcrumb-item"><a href="{{ route('movies.add') }}">Add</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        @if ($permission)
          <form class="row g-3 needs-validation" novalidate method="post" action="{{ route('movies.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body mt-2">
                  <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTabjustified" role="tablist">
                      <li class="nav-item flex-fill" role="presentation">
                          <button class="nav-link w-100 active" id="informations-tab" data-bs-toggle="tab" data-bs-target="#movie-informations" type="button" role="tab" aria-controls="informations" aria-selected="true">Movie Informations</button>
                      </li>
                      <li class="nav-item flex-fill" role="presentation">
                          <button class="nav-link w-100" id="categories-tab" data-bs-toggle="tab" data-bs-target="#movie-categories" type="button" role="tab" aria-controls="categories" aria-selected="false">Categories</button>
                      </li>
                      <li class="nav-item flex-fill" role="presentation">
                          <button class="nav-link w-100" id="episodes-tab" data-bs-toggle="tab" data-bs-target="#movie-episodes" type="button" role="tab" aria-controls="episodes" aria-selected="false">Episodes</button>
                      </li>
                  </ul>
                  <!-- Default Tabs -->
                  <div class="tab-content pt-2" id="myTabjustifiedContent">
                    <div class="tab-pane fade show active" id="movie-informations" role="tabpanel" aria-labelledby="informations-tab">
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <label for="movieName" class="form-label">Movie Name</label>
                          <input type="text" class="form-control" id="movieName" name="movieName" required>
                          <div class="invalid-feedback">
                            Required
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="movieOriginName" class="form-label">Origin Name</label>
                          <input type="text" class="form-control" id="movieOriginName" name="movieOriginName" required>
                          <div class="invalid-feedback">
                            Required
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 mt-2">
                        <label for="staticURL" class="form-label">Static URL</label>
                        <input type="text" class="form-control" id="staticURL" name="staticURL" required>
                        <div class="invalid-feedback">
                          Required
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="col-md-12 mt-2">
                            <label for="poster" class="form-label">Poster</label>
                            <input type="file" class="form-control" id="poster" name="poster" required>
                            <div class="invalid-feedback">
                              Required
                            </div>
                          </div>
                          <div class="col-md-12 mt-2">
                            <label for="annotation" class="form-label">Annotation</label>
                            <input class="form-control" type="text" name="annotation" id="annotation">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="col-md-12 mt-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 mt-2">
                        <label for="showtimes" class="form-label">Showtimes</label>
                        <input class="form-control" type="text" name="showtimes" id="showtimes">
                      </div>
                      <div class="col-md-12 mt-2">
                        <label for="trailer" class="form-label">Youtube Trailer URL</label>
                        <input class="form-control" type="text" name="trailer" id="trailer">
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-3">
                          <label for="duration" class="form-label">Duration</label>
                          <input class="form-control" type="text" name="duration" id="duration">
                        </div>
                        <div class="col-md-3">
                          <label for="currentOfEpisodes" class="form-label">Current number of episodes</label>
                          <input class="form-control" type="number" name="currentOfEpisodes" id="currentOfEpisodes">
                        </div>
                        <div class="col-md-3">
                          <label for="totalOfEpisodes" class="form-label">Total number of episodes</label>
                          <input class="form-control" type="number" name="totalOfEpisodes" id="totalOfEpisodes">
                        </div>
                        <div class="col-md-3">
                          <label for="releaseYear" class="form-label">Release year</label>
                          <input class="form-control" type="number" name="releaseYear" id="releaseYear">
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="movie-categories" role="tabpanel" aria-labelledby="categories-tab">
                      Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                    </div>
                    <div class="tab-pane fade" id="movie-episodes" role="tabpanel" aria-labelledby="episodes-tab">
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-8">
                              <input type="text" id="server-name" class="form-control" placeholder="Server name">
                            </div>
                            <div class="col-md-4">
                              <button id="add-section" class="btn btn-success">Add server +</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="sections-container"></div>
                    </div>
                  </div><!-- End Default Tabs -->
                  <div class="col-12 mt-4">
                    <button class="btn btn-primary" type="submit">Add</button>
                  </div>
                </div>
            </div>
          </form>
        @else
          <div class="card">
            <h class="card-body">
              <h1 class="text-center mt-4">Permission denied</h1>
            </div>
          </div>
        @endif
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
            let sectionIndex = 0;
            $("#add-section").click(function (event) {
              event.preventDefault()
                let serverName = $("#server-name").val().trim();
                if (serverName === "") {
                    alert("Vui lòng nhập tên server!");
                    return;
                }
                let sectionId = "server_" + sectionIndex;
                let newSection = `
                    <div class="mt-4 section border p-3 rounded shadow-sm" data-section="${sectionId}">
                        <h4>${serverName}</h4>
                        <input type="hidden" name="servers[${sectionIndex}][name]" value="${serverName}">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Link</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                <tr>
                                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][0][name]" value="1"></td>
                                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][0][slug]" value="tap-1"></td>
                                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][0][link]"></td>
                                    <td><button class="btn btn-danger delete-row">Delete</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-warning add-row">+ Add new episode</button>
                        <button class="btn btn-danger delete-section">Delete server</button>
                    </div>
                `;
                $("#sections-container").append(newSection);
                $("#server-name").val("");
                sectionIndex++;
            });

            $(document).on("click", ".add-row", function (event) {
                event.preventDefault()
                let section = $(this).closest(".section");
                let sectionIndex = section.attr("data-section").split("_")[1];
                let episodeIndex = section.find(".table-body tr").length;

                let newRow = `<tr>
                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][${episodeIndex}][name]"></td>
                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][${episodeIndex}][slug]"></td>
                    <td><input type="text" class="form-control" name="servers[${sectionIndex}][episodes][${episodeIndex}][link]"></td>
                    <td><button class="btn btn-danger delete-row">Delete</button></td>
                </tr>`;
                section.find(".table-body").append(newRow);
            });

            $(document).on("click", ".delete-row", function () {
                $(this).closest("tr").remove();
            });

            $(document).on("click", ".delete-section", function () {
                $(this).closest(".section").remove();
            });
        });
   </script>
</body>

</html>