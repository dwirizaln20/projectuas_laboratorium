

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Laboratorium</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url(); ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= session('username'); ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in</div>
              <div class="dropdown-divider"></div>
              <a href="<?= site_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('login'); ?>">Laboratorium</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('login'); ?>">St</a>
          </div>
          <ul class="sidebar-menu">
            <?= $this->include('layout/menu') ?>
          </ul>
        </aside>
      </div>

      <!-- main content -->
      <?= $this->renderSection('content') ?>

      <!-- footer -->
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= Date('Y'); ?> <div class="bullet"></div> Design By <a href="#">Kelompok SI Penggunaan Laboratorium</a>
        </div>
        <div class="footer-right">
          V. 1.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/template/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

  <!-- datatables -->
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>

  <!-- Page Specific JS File -->  

  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>
  <script src="<?=base_url()?>/template/assets/js/page/forms-advanced-forms.js"></script>
</body>
</html>
