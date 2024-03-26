<div class="row">
    <div class="col-md-8">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label text-end">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" autofocus required value="{{ $name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label text-end">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required value="{{ $email }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label text-end">
                Password
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" @unless(str_contains(request()->url(), 'edit')) required  @endunless >
            </div>
        </div>
        @unless(str_contains(request()->url(), 'edit'))
        <div class="mb-3 row">
            <label for="password_confirmation" class="col-sm-2 col-form-label text-end">
                Confirm Password
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>
        @endunless
    </div>
</div>