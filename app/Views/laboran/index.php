<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard Laboran</h1>
    </div>

    <div class="section-body">

      <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Riwayat Pinjaman</h4>
                  </div>
                  <div class="card-body">
                    <?= countData('peminjaman'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-spinner"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Perlu Persetujuan</h4>
                  </div>
                  <div class="card-body">
                    <?= countDataByStatus('verifikasi') ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Daftar Ruangan</h4>
                  </div>
                  <div class="card-body">
                    <?= countRuangan() ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Daftar Jadwal</h4>
                  </div>
                  <div class="card-body">
                    <?= countJadwal(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </div>
  </section>
</div>
<?= $this->endSection() ?>