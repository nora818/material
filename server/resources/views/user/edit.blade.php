@extends('layout')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">User Management</li>
        <li class="breadcrumb-item active" aria-current="page">Edit user</li>
    </ol>
</nav>
@stop

@section('content')

@include('partials.errors')

<form role="form" method="POST" action="{{ route('user.update', $id) }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @method('PUT')
    @include('user._form')

    <div class="row">
        <div class="col-md-8">
            <div class="form-group row">
                <div class="col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-disk-o"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>

@stop