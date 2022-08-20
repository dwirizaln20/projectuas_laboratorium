<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Riwayat Peminjaman</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
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
            <div class="card-header d-flex justify-content-between">
              <h4>Riwayat Peminjam</h4>
              <?php if (session('all_btn_delete')): ?>
                <a href="<?= site_url('peminjam/hapusSemua/ditolak/') . session('id_user')?>" class="btn btn-danger" onclick="return confirm('Apa anda yakin ingin menghapus semua data ?')"><i class="fas fa-trash"></i> Hapus Semua Data</a>
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
                      <th>Detail</th>
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
                          
                          <a href="<?= site_url('peminjam/download_surat_balasan'); ?>/<?= $row->id_peminjaman; ?>" class="btn btn-sm btn-outline-success"><span><i class="fas fa-download"></i></span> Download</a>
                        
                        <?php else: ?>

                          -

                        <?php endif ?>
                      </td>
                      <td>
                        <a href="<?= site_url('peminjam/detail'); ?>/<?= $row->id_peminjaman; ?>" class="btn btn-sm btn-info">Detail</a>
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