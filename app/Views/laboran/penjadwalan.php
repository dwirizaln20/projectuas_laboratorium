<?= $this->extend('layout/default'); ?>

<?= $this->section('content'); ?>
<div class="main-content">
<section class="section">
  <div class="section-header">
    <h1>Penjadwalan</h1>
  </div>

  <?php if (session()->getFlashData('success') || session()->getFlashData('error')): ?>
  <div class="alert <?= session()->getFlashData('success') ? 'alert-success' : 'alert-danger' ?> alert-dismissible show fade">
    <div class="alert-body">
      <button class="close" data-dismiss="alert">
        <span>×</span>
      </button>
      <?= session()->getFlashData('success') ? 'Success ! '.session()->getFlashData('success') : 'Error ! '.session()->getFlashData('error') ?>
    </div>
  </div>
  <?php endif ?>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-5 col-lg-5">
        <div class="card">
          <div class="card-header">
            <h4>Jadwalkan peminjam</h4>
          </div>
          <div class="table-responsive table-striped">
            <table class="table table-striped" id="sortable-table" style="font-size: 1rem">
              <tbody class="ui-sortable">
                <tr>
                  <td>Nama Peminjam</td>
                  <td>:</td>
                  <td><?= $peminjam->nama_peminjam; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>:</td>
                  <td><?= $peminjam->no_telepon; ?></td>
                </tr>
                <tr>
                  <td>Ruangan</td>
                  <td>:</td>
                  <td><?= $peminjam->nama_ruangan; ?></td>
                </tr>
                <tr>
                  <td>Kapasistas</td>
                  <td>:</td>
                  <td><?= $peminjam->kapasitas; ?></td>
                </tr>
                <tr>
                  <td>Tanggal Pinjam</td>
                  <td>:</td>
                  <td><?= $peminjam->tgl_awal_pinjam; ?> s/d <?= $peminjam->tgl_akhir_pinjam; ?></td>
                </tr>
                <tr>
                  <td>Kegiatan</td>
                  <td>:</td>
                  <td><?= $peminjam->kegiatan; ?></td>
                </tr>
                <tr>
                  <td colspan="3">
                    <div class="text-danger">* Jadwalkan jam kegiatan</div>
                  </td>
                </tr>
                <form action="<?= site_url('laboran/jadwalkan'); ?>" method="post">
                  <?= csrf_field(); ?>
                  <input type="hidden" name="id_peminjaman" value="<?= $peminjam->id_peminjaman; ?>">
                  <input type="hidden" name="id_ruangan" value="<?= $peminjam->id_ruangan; ?>">
                  <tr>
                    <td>Jam Mulai Kegiatan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-clock"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control timepicker" name="jam_mulai">
                      </div>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Jam Akhir Kegiatan</td>
                    <td>:</td>
                    <td>
                      <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-clock"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control timepicker" name="jam_akhir">
                      </div>
                    </div>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td class="text-right">
                      <button type="submit" class="btn btn-sm btn-outline-primary">Jadwalkan</button>
                    </td>
                  </tr>
                </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-7 col-lg-7">
        <div class="card">
          <div class="card-header">
            <h4 class="text-primary">Daftar ruangan ( <?= $peminjam->nama_ruangan; ?> )</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md" style="font-size: 1rem">
              <thead>
                    <tr>
                      <th>#</th>
                      <th>Peminjam</th>
                      <th>Nama Lab</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
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
<?= $this->endSection(); ?>