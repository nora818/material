<div class="row">
    <div class="col-md-8">
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label text-end">Comments</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" autofocus required value="{{ $name }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="author" class="col-sm-2 col-form-label text-end">Commentator</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="author" name="author" required value="{{ $author }}">
            </div>
        </div>
    </div>
</div>
