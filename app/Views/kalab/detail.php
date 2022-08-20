<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Riwayat</h1>
      <button onclick="window.history.back();" class="mx-4 btn btn-primary text-white">Kembali</button>
    </div>

    <div class="section-body">

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Detail Peminjam</h4>
            </div>
            <div class="card-body">
                
              <div class="table-responsive table-striped">
                <table class="table table-striped" id="sortable-table">
                  <tbody class="ui-sortable">
                    <tr>
                      <td>Nama Pemohon</td>
                      <td>:</td>
                      <td><?= $peminjam->nama_peminjam; ?></td>
                    </tr>
                    <tr>
                      <td>No Telepon</td>
                      <td>:</td>
                      <td><?= $peminjam->no_telepon; ?></td>
                    </tr>
                    <tr>
                      <td>Status Pemohon</td>
                      <td>:</td>
                      <td><?= $peminjam->status_peminjam; ?></td>
                    </tr>
                    <tr>
                      <td>NIP / NIM</td>
                      <td>:</td>
                      <td><?= $peminjam->no_identitas; ?></td>
                    </tr>
                    <tr>
                      <td>Asal Pemohon</td>
                      <td>:</td>
                      <td><?= $peminjam->asal_peminjam; ?></td>
                    </tr>
                    <?php if ($peminjam->asal_peminjam == 'luar prodi'): ?>
                    <tr>
                      <td>Surat Permohonan</td>
                      <td>:</td>
                      <td>
                        <a href="<?= site_url('kalab/download_bukti'); ?>/<?= $peminjam->id_peminjaman; ?>" class="btn btn-sm btn-outline-success"><span><i class="fas fa-download"></i></span> Download</a>
                      </td>
                    </tr> 
                    <?php endif ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Detail Ruangan</h4>
            </div>
            <div class="card-body">
                
              <div class="table-responsive table-striped">
                <table class="table table-striped" id="sortable-table">
                  <tbody class="ui-sortable">
                   <tr>
                      <td>Ruangan</td>
                      <td>:</td>
                      <td>
                        <?php foreach ($ruangan as $row): ?>
                          <?= $peminjam->id_ruangan == $row->id_ruangan ? $row->nama_ruangan: null?>
                        <?php endforeach ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Kapasitas</td>
                      <td>:</td>
                      <td><?= $peminjam->kapasitas; ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal awal peminjaman</td>
                      <td>:</td>
                      <td><?= date('d F Y', strtotime($peminjam->tgl_awal_pinjam)); ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Akhir peminjaman</td>
                      <td>:</td>
                      <td><?= date('d F Y', strtotime($peminjam->tgl_akhir_pinjam)); ?></td>
                    </tr>
                    <tr>
                      <td>Jam Peminjaman</td>
                      <td>:</td>
                      <td>

                        <?= is_object($jadwal) ? $jadwal->jam_mulai." - ".$jadwal->jam_akhir : "Belum Dijadwalkan" ?>

                      </td>
                    </tr>
                    <tr>
                      <td>Kegiatan</td>
                      <td>:</td>
                      <td><?= $peminjam->kegiatan; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div> 

            </div>
            <div class="card-footer text-right bg-whitesmoke">
              <a href="<?= site_url('kalab/tolak'); ?>/<?= $peminjam->id_peminjaman; ?>" class="btn btn-danger">Tolak Permohonan</a>

              <form class="d-inline" action="<?= site_url('kalab/acc'); ?>/<?= $peminjam->id_peminjaman; ?>/<?= $peminjam->kode_status; ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="nama_peminjam" value="<?= $peminjam->nama_peminjam; ?>">
                <input type="hidden" name="no_telepon" value="<?= $peminjam->no_telepon; ?>">
                <?php foreach ($ruangan as $row): ?>
                  <?php if ($peminjam->id_ruangan == $row->id_ruangan): ?>
                    <input type="hidden" name="nama_ruangan" value="<?= $row->nama_ruangan?>">
                  <?php endif ?>
                <?php endforeach ?>
                <input type="hidden" name="tgl_awal_pinjam" value="<?= $peminjam->tgl_awal_pinjam; ?>">
                <input type="hidden" name="tgl_akhir_pinjam" value="<?= $peminjam->tgl_akhir_pinjam; ?>">
                <input type="hidden" name="jam_mulai" value="<?= is_object($jadwal) ? $jadwal->jam_mulai : null?>">
                <input type="hidden" name="jam_akhir" value="<?= is_object($jadwal) ? $jadwal->jam_akhir : null ?>">
                <button type="submit" class="btn btn-success">Acc Peminjaman</button>
              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
<?= $this->endSection() ?>