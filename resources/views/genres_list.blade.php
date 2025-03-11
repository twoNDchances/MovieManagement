@extends('base')

@section('title', 'Genres')

@section('sidebar')
<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('dashboard') }}">
    <i class="bi bi-grid"></i>
    <span>Dashboard</span>
  </a>
</li><!-- End Dashboard Nav -->

<li class="nav-heading">Managements</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="{{ route('movies.page') }}">
    <i class="bi bi-tv"></i>
    <span>Movies</span>
  </a>
</li><!-- End Movies Nav -->

<li class="nav-heading">Categories</li>

<li class="nav-item">
  <a class="nav-link" href="{{ route('genres.page') }}">
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
@endsection

@section('pagetitle')
<h1>Genres</h1>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="{{ route('genres.page') }}">Genres</a></li>
  </ol>
</nav>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12" id="alert"></div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <a type="button" class="btn btn-primary mt-4 mb-4" href="{{ route('genres.add') }}">
          <i class="bi bi-plus-circle"></i>
          <span>Add Genre</span>
        </a>
        <!-- Table with stripped rows -->
        <div id="genresListHolder"></div>
        <!-- End Table with stripped rows -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('jquery')
<script>
  $(document).ready(function() {
    callAPI(
      'get',
      '{{ route("genres.list") }}',
      function() {
        $('#genresListHolder').append(`
            <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
          `)
      },
      function(data) {
        let responseData = JSON.parse(data.responseText)
        if (responseData.genres.length == 0) {
          $('#genresListHolder').empty().append(`
              <h1 class="text-center">Empty</h1>
            `)
        } else {
          $('#genresListHolder').empty().append(`
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Genre Name</th>
                    <th class="text-center">Static URL</th>
                    <th class="text-end">View</th>
                    <th class="text-end">Delete</th>
                  </tr>
                </thead>
                <tbody id="genresList">
                </tbody>
              </table>
            `)
          for (let index = 0; index < responseData.genres.length; index++) {
            const element = responseData.genres[index];
            let routeView = "{{ route('genres.view', ['staticURL' => '__STATIC_URL__']) }}"
            let routeDelete = "{{ route('genres.delete', ['staticURL' => '__STATIC_URL__']) }}"
            routeView = routeView.replace('__STATIC_URL__', element.staticURL)
            routeDelete = routeDelete.replace('__STATIC_URL__', element.staticURL)
            $('#genresList').append(`
                <tr id="${element.staticURL}">
                  <td>${element.genreName}</td>
                  <td class="text-center">${element.staticURL}</td>
                  <td class="text-end"><a type="button" class="btn btn-link" href="${routeView}">View</a></td>
                  <td class="text-end">
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#${element.staticURL}Modal">Delete</button>
                      <div class="modal" id="${element.staticURL}Modal" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Genre Deleting</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure to delete ${element.genreName} genre?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="${element.staticURL}CloseButton">Close</button>
                              <button type="button" class="btn btn-danger" onclick=deleteGenre("${element.staticURL}","${routeDelete}") id="${element.staticURL}DeleteButton">Delete</button>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Disabled Animation Modal-->
                  </td>
                </tr>
              `)
          }
        }
      },
      function(error) {
        if (error.status == 403) {
          $('#moviesListHolder').empty().append(`
              <h1 class="text-center">Permission denied</h1>
            `)
          return
        }
      }
    )
  })

  function deleteGenre(staticURL, endpoint) {
    callAPI(
      'delete',
      endpoint,
      function() {
        $(`#${staticURL}DeleteButton`).empty().attr('disabled', true).append(`
          <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        `)
      },
      function(data) {
        $(`#${staticURL}CloseButton`).click()
        $(`#${staticURL}`).remove()
        let responseData = JSON.parse(data.responseText)
        $('#alert').append(`
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${responseData.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `)
      },
      function(error) {
        $(`#${staticURL}CloseButton`).click()
        $(`#${staticURL}DeleteButton`).empty().removeAttr('disabled').text('Delete')
        let responseError = JSON.parse(error.responseText)
        $('#alert').append(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${responseError.message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `)
      },
      null,
      true
    )
  }

  function callAPI(method, endpoint, onLoading, onSuccess, onError, body = null, token = false) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 0 || this.readyState == 1 || this.readyState == 2 || this.readyState == 3) {
        onLoading()
      } else if (this.readyState == 4 && this.status == 200) {
        onSuccess(this)
      } else if (this.status != 200) {
        onError(this)
      }
    }
    xhr.open(String(method).toUpperCase(), endpoint);
    xhr.setRequestHeader('Content-Type', 'application/json')
    if (token == true) {
      xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}")
    }
    xhr.timeout = 5000
    if (body == null) {
      xhr.send();
    } else {
      xhr.send(body);
    }
  }
</script>
@endsection