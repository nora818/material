@extends('layout')

@section('styles')
<style>
    .form-signin {
        max-width: 400px;
        padding: 15px;
        padding-top: 100px;
    }
</style>
@endsection

@section('content')

<main class="form-signin w-100 m-auto text-center">
    <form method="POST" action="{{ url('register') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <img class="mb-4" src="{{ asset('asset/img/book-logo.svg') }}" alt="" width="72" height="57">
        @include('partials.errors')

        <div class="form-floating mb-1">
            <input type="text" class="form-control" id="username" name="name" placeholder="Username">
            <label for="username">Username</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-1">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-1">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">
            <label for="password_confirmation">Password Confirmation</label>
        </div>
        <button class="w-100 btn btn-lg btn-success" type="submit">Register</button>
    </form>
</main>
@endsection