<style>
    .btn-bd-download {
        font-weight: 600;
        color: #ffe484;
        border-color: #ffe484;
    }
</style>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #7952b3;">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">{{ config('book.title') }}</a>
        @auth
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
        </div>
        @else
        @if(str_contains(request()->url(), 'login'))
{{--        <a class="btn btn-bd-download d-lg-inline-block my-2 my-md-0 ms-md-3" href="/register">Register</a>--}}
        @else
        <a class="btn btn-bd-download d-lg-inline-block my-2 my-md-0 ms-md-3" href="/login">Sign In</a>
        @endif
        @endauth
    </div>
</nav>
