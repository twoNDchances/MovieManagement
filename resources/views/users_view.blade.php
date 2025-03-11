@extends('base')

@section('title', 'Users')

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
    <a class="nav-link" href="{{ route('users.page') }}">
        <i class="bi bi-people"></i>
        <span>Users</span>
    </a>
</li><!-- End Users Nav -->
@endsection

@section('pagetitle')
<h1>Users</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('users.page') }}">Users</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.view', ['email' => $email]) }}">View</a></li>
    </ol>
</nav>
@endsection

@section('content')
@if ($permission)
<form class="row g-3 needs-validation" novalidate method="post" action="{{ route('users.update', ['email' => $email]) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="card">
        <div class="card-body mt-2">
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="informations-tab" data-bs-toggle="tab" data-bs-target="#user-informations" type="button" role="tab" aria-controls="informations" aria-selected="true">Informations</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#user-permissions" type="button" role="tab" aria-controls="permissions" aria-selected="false">Permissions</button>
                </li>
            </ul>
            <!-- Default Tabs -->
            <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="user-informations" role="tabpanel" aria-labelledby="informations-tab">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @if ($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>
                    <label for="password" class="form-label">Password</label>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password', null) }}">
                            @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-light" id="passwordDisplayButton" data-status="off">
                                Display
                            </button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-light" id="passwordGeneratingButton">
                                Generate
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-permissions" role="tabpanel" aria-labelledby="permissions-tab">
                    <div class="row mt-2">
                        <div class="col-md-12">Movies</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="movies[]"
                                        @if ($moviePermission->add)
                                    checked
                                    @endif
                                    id="moviesAdd" value="add">
                                    <label class="form-check-label" for="moviesAdd">Add</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="movies[]"
                                        @if ($moviePermission->list)
                                    checked
                                    @endif
                                    id="moviesList" value="list">
                                    <label class="form-check-label" for="moviesList">List</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="movies[]"
                                        @if ($moviePermission->view)
                                    checked
                                    @endif
                                    id="moviesView" value="view">
                                    <label class="form-check-label" for="moviesView">View</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="movies[]"
                                        @if ($moviePermission->update)
                                    checked
                                    @endif
                                    id="moviesUpdate" value="update">
                                    <label class="form-check-label" for="moviesUpdate">Update</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="movies[]"
                                        @if ($moviePermission->delete)
                                    checked
                                    @endif
                                    id="moviesDelete" value="delete">
                                    <label class="form-check-label" for="moviesDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('movies'))
                        <p class="text-danger">{{ $errors->first('movies') }}</p>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">Genres</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        @if ($genrePermission->add)
                                    checked
                                    @endif
                                    id="genresAdd" value="add">
                                    <label class="form-check-label" for="genresAdd">Add</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        @if ($genrePermission->list)
                                    checked
                                    @endif
                                    id="genresList" value="list">
                                    <label class="form-check-label" for="genresList">List</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        @if ($genrePermission->view)
                                    checked
                                    @endif
                                    id="genresView" value="view">
                                    <label class="form-check-label" for="genresView">View</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        @if ($genrePermission->update)
                                    checked
                                    @endif
                                    id="genresUpdate" value="update">
                                    <label class="form-check-label" for="genresUpdate">Update</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="genres[]"
                                        @if ($genrePermission->delete)
                                    checked
                                    @endif
                                    id="genresDelete" value="delete">
                                    <label class="form-check-label" for="genresDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('genres'))
                        <p class="text-danger">{{ $errors->first('genres') }}</p>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">Regions</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        @if ($regionPermission->add)
                                    checked
                                    @endif
                                    id="regionsAdd" value="add">
                                    <label class="form-check-label" for="regionsAdd">Add</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        @if ($regionPermission->list)
                                    checked
                                    @endif
                                    id="regionsList" value="list">
                                    <label class="form-check-label" for="regionsList">List</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        @if ($regionPermission->view)
                                    checked
                                    @endif
                                    id="regionsView" value="view">
                                    <label class="form-check-label" for="regionsView">View</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        @if ($regionPermission->update)
                                    checked
                                    @endif
                                    id="regionsUpdate" value="update">
                                    <label class="form-check-label" for="regionsUpdate">Update</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="regions[]"
                                        @if ($regionPermission->delete)
                                    checked
                                    @endif
                                    id="regionsDelete" value="delete">
                                    <label class="form-check-label" for="regionsDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('regions'))
                        <p class="text-danger">{{ $errors->first('regions') }}</p>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">Actors</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="actors[]"
                                        @if ($actorPermission->add)
                                    checked
                                    @endif
                                    id="actorsAdd" value="add">
                                    <label class="form-check-label" for="actorsAdd">Add</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="actors[]"
                                        @if ($actorPermission->list)
                                    checked
                                    @endif
                                    id="actorsList" value="list">
                                    <label class="form-check-label" for="actorsList">List</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="actors[]"
                                        @if ($actorPermission->view)
                                    checked
                                    @endif
                                    id="actorsView" value="view">
                                    <label class="form-check-label" for="actorsView">View</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="actors[]"
                                        @if ($actorPermission->update)
                                    checked
                                    @endif
                                    id="actorsUpdate" value="update">
                                    <label class="form-check-label" for="actorsUpdate">Update</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="actors[]"
                                        @if ($actorPermission->delete)
                                    checked
                                    @endif
                                    id="actorsDelete" value="delete">
                                    <label class="form-check-label" for="actorsDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('actors'))
                        <p class="text-danger">{{ $errors->first('actors') }}</p>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">Users</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="users[]"
                                        @if ($userPermission->add)
                                    checked
                                    @endif
                                    id="usersAdd" value="add">
                                    <label class="form-check-label" for="usersAdd">Add</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="users[]"
                                        @if ($userPermission->list)
                                    checked
                                    @endif
                                    id="usersList" value="list">
                                    <label class="form-check-label" for="usersList">List</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="users[]"
                                        @if ($userPermission->view)
                                    checked
                                    @endif
                                    id="usersView" value="view">
                                    <label class="form-check-label" for="usersView">View</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="users[]"
                                        @if ($userPermission->update)
                                    checked
                                    @endif
                                    id="usersUpdate" value="update">
                                    <label class="form-check-label" for="usersUpdate">Update</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" name="users[]"
                                        @if ($userPermission->delete)
                                    checked
                                    @endif
                                    id="usersDelete" value="delete">
                                    <label class="form-check-label" for="usersDelete">Delete</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('users'))
                        <p class="text-danger">{{ $errors->first('users') }}</p>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">Others</div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <input class="form-check-input" type="checkbox" name="others[]"
                                        @if ($otherPermission->login)
                                    checked
                                    @endif
                                    id="othersLogin" value="login">
                                    <label class="form-check-label" for="othersLogin">Login Permitted</label>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-check-input" type="checkbox" name="others[]"
                                        @if ($otherPermission->editLogin)
                                    checked
                                    @endif
                                    id="othersEditLogin" value="editLogin">
                                    <label class="form-check-label" for="othersEditLogin">Edit Login Permission for Others</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('others'))
                        <p class="text-danger">{{ $errors->first('others') }}</p>
                        @endif
                    </div>
                </div>
            </div><!-- End Default Tabs -->
            <div class="col-12 mt-4">
                <button class="btn btn-info" type="submit">Update</button>
                <a class="btn btn-link" href="{{ route('users.page') }}">Back</a>
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
@endsection

@section('jquery')
<script>
    $(document).ready(function() {
        $('#passwordGeneratingButton').on('click', function(event) {
            event.preventDefault();
            $('#password').val(generateSecurePassword(8))
        })

        $('#passwordDisplayButton').on('click', function(event) {
            event.preventDefault();
            if ($('#password').attr('data-status') == 'off') {
                $('#password').attr('type', 'text')
                $('#password').attr('data-status', 'on')
            } else {
                $('#password').attr('type', 'password')
                $('#password').attr('data-status', 'off')
            }
        })
    })

    function generateSecurePassword(length) {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()";
        const array = new Uint32Array(length);
        window.crypto.getRandomValues(array);
        return Array.from(array, x => chars[x % chars.length]).join('');
    }
</script>
@endsection