@if (Session::has('success-message'))
  <div class="alert alert-success alert-bean">
    {{ Session::get('success-message') }}
  </div>
@endif