@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"  id="success-alert">
    {{ Session::get('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script>
    var alertBox = document.getElementById("success-alert");
    var timer = setTimeout(function() {
        alertBox.remove();
    }, 3000);
</script>
@endif