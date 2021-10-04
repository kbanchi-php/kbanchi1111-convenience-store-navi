<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand logo" href="{{ route('root') }}">こんびにナビ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('convenience_stores.index') }}">Home <span
                        class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" mechod="GET" action="{{ route('convenience_stores.index') }}">
            <a class="btn btn-outline-primary my-2 my-sm-0 mr-2"
                href="{{ route('convenience_stores.create') }}">新しいコンビニを登録</a>
            <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="キーワード">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
        </form>
    </div>
</nav>
