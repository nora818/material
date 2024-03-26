<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('book.title') }}</title>

    <script src="//cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="//unpkg.com/layui@2.9.0/dist/css/layui.css" rel="stylesheet">
    <script src="//unpkg.com/layui@2.9.0/dist/layui.js"></script>
    <link href="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    @yield('styles')
</head>

<body>
    @include('partials.navbar')

    <div class="container-fluid">
        <div class="row pt-4">
            @auth
            <div class="col col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        List
                    </a>
                    <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action">Material management</a>
                    <a href="{{ route('comment.index') }}" class="list-group-item list-group-item-action">Comment management</a>
                    @if (Auth::user()->is_admin == 1)
                    <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action">User Management</a>
                    @endif
                </div>
            </div>
            @endauth

            @auth
            <div class="col col-md-9">
                <div class="card">
                    <div class="card-header">
                        @yield('breadcrumb')
                    </div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
                @else
                @yield('content')
                @endauth
            </div>
        </div>
    </div>

</body>
@yield('scripts')

</html>
