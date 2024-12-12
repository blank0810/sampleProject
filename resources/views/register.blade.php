<!DOCTYPE html>
<html lang="en">

@include('general_layouts.header')

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register Here!</p>

        <form action="/register" method="post" id="registerForm">
          <div class="input-group mb-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col">
              <button type="button" id="registerBtn" class="btn btn-primary btn-block">Sign Up</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <br>
        <p class="mb-0">
          <a href="/" class="text-center">Already a member? Sign in</a>
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
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#registerBtn').on('click', function(e) {
        Swal.fire({
          icon: 'question',
          title: 'Confirm registration',
          text: 'Do you wish to register?',
          showCancelButton: true,
          confirmButtonText: '<i class="far fa-check-circle"></i> Yes',
          cancelButtonText: '<i class="far fa-times-circle"></i> Cancel',
          confirmButtonColor: '#28a745', // Green color for the Yes button
          cancelButtonColor: '#dc3545', // Red color for the No button
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            registerUser();
          }
        })
      })
    })

    function registerUser() {
      var form = $('#registerForm');
      var formData = form.serialize();
      console.log(formData);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/register',
        type: 'post',
        data: formData,
        success: function(response) {
          if (response.success) {
            swal.fire({
              icon: 'success',
              title: 'Registration Success',
              text: response.message +
                '. To continue please log-in your account. You will be redirected to the log-in page.',
              timer: 2000,
              timerProgressBar: true
            }).then((result) => {
              window.location.href = "/";
            })
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'An error occurred: ' + response.message,
            });
          }
        },
        error: function(xhr) {
          console.log('An error occurred: ' + xhr.responseText);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred: Check the console log!!!',
          });
        }
      });
    }
  </script>
</body>

</html>
