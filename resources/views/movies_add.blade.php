@extends('base')

@section('title', 'Movies')

@section('sidebar')
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
@endsection

@section('pagetitle')
<h1>Dashboard</h1>
<nav>
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item"><a href="{{ route('movies.page') }}">Movies</a></li>
    <li class="breadcrumb-item"><a href="{{ route('movies.add') }}">Add</a></li>
  </ol>
</nav>
@endsection

@section('content')
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
              <input type="text" class="form-control" id="movieName" name="movieName" required value="{{ old('movieName', '') }}">
              <div class="invalid-feedback">
                Required
              </div>
              @if ($errors->has('movieName'))
              <p class="text-danger">{{ $errors->first('movieName') }}</p>
              @endif
            </div>
            <div class="col-md-6">
              <label for="movieOriginName" class="form-label">Origin Name</label>
              <input type="text" class="form-control" id="movieOriginName" name="movieOriginName" required value="{{ old('movieOriginName', '') }}">
              <div class="invalid-feedback">
                Required
              </div>
              @if ($errors->has('movieOriginName'))
              <p class="text-danger">{{ $errors->first('movieOriginName') }}</p>
              @endif
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <label for="staticURL" class="form-label">Static URL</label>
            <input type="text" class="form-control" id="staticURL" name="staticURL" required value="{{ old('staticURL', '') }}">
            <div class="invalid-feedback">
              Required
            </div>
            @if ($errors->has('staticURL'))
            <p class="text-danger">{{ $errors->first('staticURL') }}</p>
            @endif
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12 mt-2">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" class="form-control" id="poster" name="poster" required>
                <div class="invalid-feedback">
                  Required
                </div>
                @if ($errors->has('poster'))
                <p class="text-danger">{{ $errors->first('poster') }}</p>
                @endif
              </div>
              <div class="col-md-12 mt-2">
                <label for="annotation" class="form-label">Annotation</label>
                <input class="form-control" type="text" name="annotation" id="annotation" value="{{ old('annotation', '') }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12 mt-2">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', '') }}</textarea>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <label for="showtimes" class="form-label">Showtimes</label>
            <input class="form-control" type="text" name="showtimes" id="showtimes" value="{{ old('showtimes', '') }}">
          </div>
          <div class="col-md-12 mt-2">
            <label for="trailer" class="form-label">Youtube Trailer URL</label>
            <input class="form-control" type="text" name="trailer" id="trailer" value="{{ old('trailer', '') }}">
            @if ($errors->has('trailer'))
            <p class="text-danger">{{ $errors->first('trailer') }}</p>
            @endif
          </div>
          <div class="row mt-2">
            <div class="col-md-3">
              <label for="duration" class="form-label">Duration</label>
              <input class="form-control" type="text" name="duration" id="duration" value="{{ old('duration', '') }}">
            </div>
            <div class="col-md-3">
              <label for="currentOfEpisodes" class="form-label">Current number of episodes</label>
              <input class="form-control" type="number" name="currentOfEpisodes" id="currentOfEpisodes" value="{{ old('currentOfEpisodes', '') }}">
              @if ($errors->has('currentOfEpisodes'))
              <p class="text-danger">{{ $errors->first('currentOfEpisodes') }}</p>
              @endif
            </div>
            <div class="col-md-3">
              <label for="totalOfEpisodes" class="form-label">Total number of episodes</label>
              <input class="form-control" type="number" name="totalOfEpisodes" id="totalOfEpisodes" value="{{ old('totalOfEpisodes', '') }}">
              @if ($errors->has('totalOfEpisodes'))
              <p class="text-danger">{{ $errors->first('totalOfEpisodes') }}</p>
              @endif
            </div>
            <div class="col-md-3">
              <label for="releaseYear" class="form-label">Release year</label>
              <input class="form-control" type="number" name="releaseYear" id="releaseYear" value="{{ old('releaseYear', '') }}">
              @if ($errors->has('releaseYear'))
              <p class="text-danger">{{ $errors->first('releaseYear') }}</p>
              @endif
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
@endsection

@section('jquery')
<script>
  $(document).ready(function() {
    $('#movieName').on('input', function() {
      let movieName = $(this).val();
      let staticURL = toSlug(movieName);
      $('#staticURL').val(staticURL);
    });

    let sectionIndex = 0;
    $("#add-section").click(function(event) {
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

    $(document).on("click", ".add-row", function(event) {
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

    $(document).on("click", ".delete-row", function() {
      $(this).closest("tr").remove();
    });

    $(document).on("click", ".delete-section", function() {
      $(this).closest(".section").remove();
    });
  });

  function toSlug(str) {
    // Chuyển về chữ thường
    str = str.toLowerCase();

    // Thay thế tiếng Việt có dấu thành không dấu
    const vietnameseMap = {
      'á': 'a',
      'à': 'a',
      'ả': 'a',
      'ã': 'a',
      'ạ': 'a',
      'ă': 'a',
      'ắ': 'a',
      'ằ': 'a',
      'ẳ': 'a',
      'ẵ': 'a',
      'ặ': 'a',
      'â': 'a',
      'ấ': 'a',
      'ầ': 'a',
      'ẩ': 'a',
      'ẫ': 'a',
      'ậ': 'a',
      'é': 'e',
      'è': 'e',
      'ẻ': 'e',
      'ẽ': 'e',
      'ẹ': 'e',
      'ê': 'e',
      'ế': 'e',
      'ề': 'e',
      'ể': 'e',
      'ễ': 'e',
      'ệ': 'e',
      'í': 'i',
      'ì': 'i',
      'ỉ': 'i',
      'ĩ': 'i',
      'ị': 'i',
      'ó': 'o',
      'ò': 'o',
      'ỏ': 'o',
      'õ': 'o',
      'ọ': 'o',
      'ô': 'o',
      'ố': 'o',
      'ồ': 'o',
      'ổ': 'o',
      'ỗ': 'o',
      'ộ': 'o',
      'ơ': 'o',
      'ớ': 'o',
      'ờ': 'o',
      'ở': 'o',
      'ỡ': 'o',
      'ợ': 'o',
      'ú': 'u',
      'ù': 'u',
      'ủ': 'u',
      'ũ': 'u',
      'ụ': 'u',
      'ư': 'u',
      'ứ': 'u',
      'ừ': 'u',
      'ử': 'u',
      'ữ': 'u',
      'ự': 'u',
      'ý': 'y',
      'ỳ': 'y',
      'ỷ': 'y',
      'ỹ': 'y',
      'ỵ': 'y',
      'đ': 'd'
    };
    str = str.replace(/[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/g, match => vietnameseMap[match] || match);

    // Thay thế ký tự không phải chữ cái hoặc số thành dấu '-'
    str = str.replace(/[^a-z0-9]+/g, '-');

    // Xóa dấu '-' ở đầu và cuối nếu có
    str = str.replace(/^-+|-+$/g, '');

    return str;
  }
</script>
@endsection