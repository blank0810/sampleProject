<!DOCTYPE html>
<html lang="en">
@include('general_layouts.header')

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="/login" method="post" id="loginForm">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col">
              <button type="button" id="loginBtn" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <br>
        <p class="mb-0">
          <a href="/registration" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#loginBtn').on('click', function(e) {
        e.preventDefault();
        var form = $('#loginForm');
        var formData = form.serialize();
        $.ajax({
          url: '/login',
          type: 'post',
          data: formData,
          success: function(response) {
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
              }).then((result) => {
                window.location.href = '/dashboard'
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred: ' + response.message,
              });
            }
          },
          error: function(xhr, status, error) {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An error occurred: ' + error,
            });
          }
        })
      })
    })
  </script>
</body>

</html>
