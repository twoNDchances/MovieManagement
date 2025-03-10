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
<h1>Movies</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="{{ route('movies.page') }}">Movies</a></li>
        <li class="breadcrumb-item"><a href="{{ route('movies.view', ['staticURL' => $staticURL]) }}">View</a></li>
    </ol>
</nav>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Custom Styled Validation -->
        <form class="row g-3 needs-validation mt-2" novalidate method="post" action="{{ route('movies.update', ['staticURL' => $staticURL]) }}">
            @csrf
            @method('PATCH')
            
            <div class="col-12">
                <button class="btn btn-info" type="submit">Update</button>
                <a class="btn btn-link" type="button" id="backButton" href="{{ route('movies.page') }}">Back</a>
            </div>
        </form><!-- End Custom Styled Validation -->

    </div>
</div>
@endsection

@section('jquery')
<script>
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

    $(document).ready(function() {
    });
</script>
@endsection