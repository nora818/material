@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
    <strong>Whoops!</strong>There were some problems with your input.<br><br>
    <ul class="list-styled">
        @foreach ($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif