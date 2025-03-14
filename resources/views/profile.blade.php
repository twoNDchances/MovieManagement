@extends('base')

@section('title', 'Profile')

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
<h1>Profile</h1>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="{{ route('profile.page') }}">Profile</a></li>
  </ol>
</nav>
@endsection

@section('content')
<div class="row">
  <div class="col-xl-4">

    <div class="card">
      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

        <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <h2>{{ $name }}</h2>
        <h3>{{ $email }}</h3>
      </div>
    </div>

  </div>

  <div class="col-xl-8">

    <div class="card">
      <div class="card-body pt-3">
        <form method="post" action="{{ route('profile.update') }}">
          @csrf
          @method('PATCH')
          <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $name) }}">
              @if ($errors->has('name'))
              <p class="text-danger">{{ $errors->first('name') }}</p>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $email) }}">
              @if ($errors->has('email'))
              <p class="text-danger">{{ $errors->first('email') }}</p>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label for="currentPassword" class="col-sm-2 col-form-label">Current Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="currentPassword" name="currentPassword">
              @if ($errors->has('currentPassword'))
              <p class="text-danger">{{ $errors->first('currentPassword') }}</p>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <label for="password" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password">
              @if ($errors->has('password'))
              <p class="text-danger">{{ $errors->first('password') }}</p>
              @endif
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-12 text-end">
              <button class="btn btn-info" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection

@section('jquery')
@endsection