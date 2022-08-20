<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Daftar Jadwal</h1>
    </div>

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
                      <th>Aksi</th>
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
                        <td>
                          <a href="<?= site_url('laboran/hapusJadwal/').$row->id_jadwal; ?>/<?= $row->id_peminjaman; ?>" class="btn btn-danger" onclick="return confirm('Apakah ingin hapus jadwal ?')"><i class="fas fa-trash"></i> Hapus Jadwal</a>
                        </td>
                      </tr>
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