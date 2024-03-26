@extends('layout')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">library management</li>
        <li class="breadcrumb-item active" aria-current="page">add book</li>
    </ol>
</nav>
@stop

@section('content')

<div class="col-sm-12">

    @include('partials.errors')

    <form role="form" method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('book._form')

        <div class="row">
            <div class="col-md-8">
                <div class="form-group row">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-disk-o"></i>
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

@stop