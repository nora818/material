<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>{{ config('book.title') }}</title>

    <link href="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
</head>

<body>
<!-- Page Header-->
<header class="masthead">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>{{ config('book.title') }}</h1>
                </div>
            </div>
            <div class="d-flex justify-content-center" style="position: relative; top: 30px;"><a
                    class="btn btn-primary text-uppercase" href="/product">More →</a></div>
        </div>
    </div>
</header>
</body>

</html>
