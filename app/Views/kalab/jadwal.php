<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Daftar Jadwal</h1>
    </div>

     <?php if (session()->getFlashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible show fade">
          <div class="alert-body">
              <button class="close" data-dismiss="alert">x</button>
              <b>Success !</b>
              <?= session()->getFlashdata('success') ?>
          </div>
          </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')) : ?>
          <div class="alert alert-danger alert-dismissible show fade">
          <div class="alert-body">
              <button class="close" data-dismiss="alert">x</button>
              <b>Error !</b>
              <?= session()->getFlashdata('error') ?>
          </div>
          </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('warning')) : ?>
          <div class="alert alert-warning alert-dismissible show fade">
          <div class="alert-body">
              <button class="close" data-dismiss="alert">x</button>
              <?= session()->getFlashdata('warning') ?>
          </div>
          </div>
      <?php endif; ?>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-10">
          <div class="card">
            <div class="card-header">
              <h4>Daftar Jadwal</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Peminjam</th>
                      <th>Nama Lab</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($jadwal as $key => $row): ?>
                      <tr>
                        <td><?= ++$key; ?></td>
                        <td><?= $row->nama_peminjam; ?></td>
                        <td>
                          <?php foreach ($ruangan as $value): ?>
                            <?= $row->id_ruangan == $value->id_ruangan ? $value->nama_ruangan : null ?>
                          <?php endforeach ?>
                        </td>
                        <td><?= $row->tgl_awal_pinjam; ?> s/d <?= $row->tgl_akhir_pinjam; ?></td>
                        <td><?= $row->jam_mulai; ?> - <?= $row->jam_akhir; ?></td>
                        <td>
                          <?php if ($tgl_sekarang->isBefore($row->tgl_akhir_pinjam)): ?>
                            <div class="badge badge-info">Belum Tenggat</div>
                          <?php else: ?>
                            <div class="badge badge-danger">Sudah Melewati Tenggat Peminjaman</div>
                          <?php endif ?>
                        </td>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->endSection() ?>