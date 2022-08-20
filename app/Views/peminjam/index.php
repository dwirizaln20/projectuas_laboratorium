<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard Peminjam</h1>
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
                    <?= countPeminjamanById(session('id_user')) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sudah Disetujui</h4>
                  </div>
                  <div class="card-body">
                    <?= countDataByStatus('acc', session('id_user')) ?>
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
                    <h4>Proses Verifikasi</h4>
                  </div>
                  <div class="card-body">
                    <?= countDataByStatus('verifikasi', session('id_user')) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-trash-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Permohonan Ditolak</h4>
                  </div>
                  <div class="card-body">
                    <?= countDataByStatus('ditolak', session('id_user')) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </div>
  </section>
</div>
<?= $this->endSection() ?>