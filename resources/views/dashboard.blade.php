@extends('base')

@section('title', 'Dashboard')

@section('sidebar')
<li class="nav-item">
  <a class="nav-link" href="{{ route('dashboard') }}">
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
@endsection

@section('pagetitle')
<h1>Dashboard</h1>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  </ol>
</nav>
@endsection

@section('content')
<section class="dashboard">
  <div class="row">
    <!-- Left side columns -->
    <div class="col-lg-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Movies</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <a href="{{ route('movies.page') }}">
                <i class="bi bi-tv"></i>
              </a>
            </div>
            <div class="ps-3">
              <h6 class="text-primary">{{ $movieLength }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Genres</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <a href="{{ route('genres.page') }}">
                <i class="bi bi-tags"></i>
              </a>
            </div>
            <div class="ps-3">
              <h6 class="text-success">{{ $genreLength }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card info-card customers-card">
        <div class="card-body">
          <h5 class="card-title">Regions</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <a href="{{ route('regions.page') }}">
                <i class="bi bi-globe"></i>
              </a>
            </div>
            <div class="ps-3">
              <h6 class="text-danger">{{ $regionLength }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Actors</h5>
          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <a href="{{ route('actors.page') }}">
                <i class="bi bi-person-lines-fill"></i>
              </a>
            </div>
            <div class="ps-3">
              <h6 class="text-info">{{ $actorLength }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Right side columns -->
  </div>
</section>
@endsection

@section('jquery')
@endsection