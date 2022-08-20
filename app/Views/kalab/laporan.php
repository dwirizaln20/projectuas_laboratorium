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
            <div class="card-header">
              <h4 class="text-success">Riwayat Laporan Laboran</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Peminjam</th>
                      <th>No. telepon</th>
                      <th>Asal Pemohon</th>
                      <th>Disposisi</th>
                      <th>tgl pinjam</th>
                      <th>jam pinjam</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($peminjaman as $row): ?>
                      <?php if ($row->kode_status != 'telah disetujui' AND $row->kode_status != 'peminjaman ditolak'): ?>
                        
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->nama_peminjam; ?></td>
                        <td><?= $row->no_telepon; ?></td>
                        <td><?= $row->asal_peminjam; ?></td>
                        <td>
                          <?php foreach ($ruangan as $value): ?>
                            <?php if ($row->id_ruangan == $value->id_ruangan): ?>
                              <?= $value->nama_ruangan?> 
                            <?php endif ?>
                          <?php endforeach ?>
                        </td>
                        <td>
                          <?= $row->tgl_awal_pinjam; ?> s/d <?= $row->tgl_akhir_pinjam; ?>
                        </td>
                        <td>
                          <?php foreach ($jadwal as $value): ?>
                            <?= $row->id_peminjaman == $value->id_peminjaman ? $value->jam_mulai." - ".$value->jam_akhir : null ?>
                          <?php endforeach ?>
                        </td>
                        <td>
                          <a href="<?= base_url('kalab/detail'); ?>/<?= $row->id_peminjaman; ?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                      </tr>
                      
                      <?php endif ?>
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