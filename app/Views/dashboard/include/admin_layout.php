<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editorail | Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet"
    href="<?= base_url() ?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?= base_url() ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/select2/css/select2.min.css"> -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/select2.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/jqvmap/jqvmap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/toastr/toastr.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet"
    href="<?= base_url() ?>assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/adminlte/dist/css/adminlte.min.css">
  <?= $this->renderSection('stylesheet') ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-th-large"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-id-card mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url("login") ?>" class="dropdown-item dropdown-footer"><i
                class="fas fa-sign-out-alt mr-2"></i> <b>Logout</b></a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Editorial</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>assets/adminlte/dist/img/avatar5.png" class="img-circle elevation-2"
              alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?= $_SESSION["userinfo"]->fullname ?>
            </a>
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
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item menu-open">
              <a href="<?= base_url("dashboard") ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php if ((isset($_SESSION["menuaccess"]) && !empty($_SESSION["menuaccess"])) || ($_SESSION["userinfo"]->roleid == 1)): ?>
              <!-- System Administrator -->
              <?php if (filtermenu('ROLES') == true || filtermenu('USERS') || filtermenu('ROLEACC')): ?>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-wrench"></i>
                    <p>
                      System Administration
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    <?php if (filtermenu('ROLES')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("sysadmin/roles") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role Master</p>
                        </a>
                      </li>
                    <?php endif //Roles ?>
                    <?php if (filtermenu('USERS')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("sysadmin/users") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>User Master</p>
                        </a>
                      </li>
                    <?php endif //Users ?>
                    <?php if (filtermenu('ROLEACC')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("sysadmin/roleaccess") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role Access</p>
                        </a>
                      </li>
                    <?php endif //Role Access ?>
                  </ul>
                </li>
              <?php endif //System Administrator ?>

              <!-- Administration -->
              <?php if (filtermenu('CLIENT') == true || filtermenu('CATE') || filtermenu('TAGS')): ?>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-university"></i>
                    <p>
                      Masters
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    <!-- Client Master -->
                    <?php if (filtermenu('CLIENT')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("masters/client") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Client Master</p>
                        </a>
                      </li>
                    <?php endif //Client Master ?>
                    <!-- Category Master -->
                    <?php if (filtermenu('CATE')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("masters/cate") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Category Master</p>
                        </a>
                      </li>
                    <?php endif //Category Master ?>
                    <!-- Tag Master -->
                    <?php if (filtermenu('TAGS')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("masters/tags") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tag Master</p>
                        </a>
                      </li>
                    <?php endif //Keyword Master ?>
                    <?php if (filtermenu('KEYWORDS')): ?>
                      <li class="nav-item">
                        <a href="<?= base_url("masters/keywords") ?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Stockcode-Keywords</p>
                        </a>
                      </li>
                    <?php endif //Keyword Master ?>
                  </ul>
                </li>
              <?php endif //Administration ?>
              <!-- NEWS -->
              <?php if (filtermenu('NEWS') == true): ?>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                      News
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                    <!-- English News -->
                    <li class="nav-item">
                      <a href="<?= base_url("news/list/eng") ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>English</p>
                      </a>
                    </li>
                    <!-- Hindi News -->
                    <li class="nav-item">
                      <a href="<?= base_url("news/list/hindi") ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Hindi</p>
                      </a>
                    </li>
                    <!-- Tag Master -->
                  </ul>
                </li>
              <?php endif //NEWS ?>
            <?php endif //$_SESSION["menuaccess"] check ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content') ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer text-center">
      <strong>Copyright &copy; 2023-2024 <a href="https://investmentguruindia.com">InvestmentGuruIndia.com</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Select2 -->
  <script src="<?= base_url() ?>assets/js/select2.full.min.js"></script>
  <!-- <script src="<?= base_url() ?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script> -->

  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/adminlte/dist/js/adminlte.js"></script>

  <!-- Summernote -->
  <script src="<?= base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>

  <?= $this->renderSection('javascript') ?>
</body>

</html>