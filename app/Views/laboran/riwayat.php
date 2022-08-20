<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Riwayat Peminjaman</h1>
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
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4>Riwayat Peminjam</h4>
              <?php if (session('all_btn_delete')): ?>
                <a href="<?= site_url('laboran/hapusSemua/ditolak')?>" class="btn btn-danger btn-sm" onclick="return confirm('Apa anda yakin ingin menghapus semua data ?')"><i class="fas fa-trash"></i> Hapus Semua Data</a>
              <?php endif ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Peminjam</th>
                      <th>Status Peminjam</th>
                      <th>Asal Pemohon</th>
                      <th>Ruangan</th>
                      <th>Status</th>
                      <th>Surat Balasan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($peminjaman as $key => $row): ?>
                    <tr>
                      <td><?= ++$key; ?></td>
                      <td><?= $row->nama_peminjam; ?></td>
                      <td><?= $row->status_peminjam; ?></td>
                      <td><?= $row->asal_peminjam; ?></td>
                      <td>

                        <?php foreach ($ruangan as $value): ?>
                          <?php if ($row->id_ruangan == $value->id_ruangan): ?>
                            <?= $value->nama_ruangan?> 
                          <?php endif ?>
                        <?php endforeach ?>

                      </td>
                      <td>

                        <?php 
                          $info = '';
                          $msg = '';
                          if ($row->kode_status == 'telah disetujui') {
                            $info = 'success';
                            $msg = 'Telah Disetujui';
                          } else if ($row->kode_status == null OR $row->kode_status != 'peminjaman ditolak') {
                            $info = 'warning';
                            $msg = 'Proses Verifikasi';
                          } else {
                            $info = 'danger';
                            $msg = 'Peminjaman Ditolak';
                          }
                        ?>
                        <div class="badge badge-<?= $info; ?>"><?= $msg; ?></div>
                      </td>
                      <td class="text-center">
                        <?php if ($row->bukti_peminjaman != null): ?>
                          
                          <a href="<?= site_url('laboran/download_surat_balasan'); ?>/<?= $row->id_peminjaman; ?>" class="btn btn-sm btn-outline-success"><span><i class="fas fa-download"></i></span> Download</a>
                        
                        <?php else: ?>

                          -

                        <?php endif ?>
                      </td>
                      <td>
                          <?php if ($row->kode_status == null OR $row->kode_status == 'telah disetujui' OR $row->kode_status == 'peminjaman ditolak'): ?>
                            <a href="<?= site_url('laboran/detail'); ?>/<?= $row->id_peminjaman; ?>" class="btn btn-sm btn-info">Detail</a>
                          <?php else: ?>
                            <?php foreach ($jadwal as $value): ?>
                              <?php if ($value->id_peminjaman == $row->id_peminjaman): ?>
                                <?php if ($row->kode_status == 'dijadwalkan'): ?>
                                  <a href="<?= site_url('laboran/acc'); ?>/<?= $row->id_peminjaman; ?>/<?= $value->id_jadwal; ?>" class="btn btn-sm btn-outline-success">Serahkan Ke Kalab</a>
                                <?php else: ?>
                                  <div class="badge badge-warning">Menunggu Acc Kalab</div>
                                <?php endif ?>

                              <?php endif ?>
                            <?php endforeach ?>
                          <?php endif ?>
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