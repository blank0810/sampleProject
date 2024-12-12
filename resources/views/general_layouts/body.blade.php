<!DOCTYPE html>
<html lang="en">
@include('general_layouts.header')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
      <a href="/dashboard" class="brand-link d-flex justify-content-center">
        <!-- Brand Logo -->
        <div class="info">
          <i class="fas fa-building"></i>
        </div>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="/" class="d-block">Ehnand Azucena</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                                with font-awesome or any other icon font library -->
            <li class="nav-header">PHP Assessment</li>
            <li class="nav-item">
              <a href="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Form
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->

      <div class="sidebar-custom p-2"> <!-- Adding padding to the div -->
        <a href="/logout" id="signoutBtn" class="btn btn-danger btn-block mx-auto" style="height: 80%;">
          <!-- Using Bootstrap's mx-auto for horizontal centering -->
          <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
        </a>
      </div>
  </div>
  <!-- /.sidebar-custom -->
  </aside>

  @yield('content')
  @include('general_layouts.footer')
  </div>

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <!-- date-range-picker -->
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- dropzonejs -->
  <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
  <!-- SweetAlert2 -->
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Script responsible for putting and opening up the sub menu of buttons or putting up active class to the buttons -->
  <script>
    $(document).ready(function() {
      // Function to set the active class to the navigation link corresponding to the current URL
      var currentUrl = window.location.href;

      // Find the button assigned for the displayed page
      $('.nav-item').each(function() {
        var navLink = $(this).find('a').attr('href');
        if (currentUrl.includes(navLink)) {
          // Add 'menu-open' class to all parent buttons up to the top level
          $(this).parents('.nav-item').addClass('menu-open');
          // Add 'active' class to the parent button's anchor tag
          $(this).parents('.nav-item').find('a.nav-link').first().addClass('active');
          // Find the child button responsible for the displayed page
          $(this).find('.nav-item').each(function() {
            var childNavLink = $(this).find('a').attr('href');
            if (currentUrl.includes(childNavLink)) {
              // Add 'active' class to the child button's anchor tag
              $(this).find('.nav-link').addClass('active');
              return false; // Exit the loop once the responsible child button is found
            }
          });
          return false; // Exit the loop once the buttons are found
        }
      });

      // If no parent button found, search for the button directly based on the URL
      if ($('.nav-item.active').length === 0) {
        $('.nav-item').each(function() {
          var navLink = $(this).find('a').attr('href');
          if (currentUrl.includes(navLink)) {
            $(this).addClass('active');
            $(this).find('.nav-link').addClass('active');
            return false; // Exit the loop once the button is found
          }
        });
      }
    });
  </script>
  @yield('pagespecificscript')
</body>

</html>
