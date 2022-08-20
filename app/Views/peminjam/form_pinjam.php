<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Peminjaman</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <!-- form peminjam -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Form Peminjam</h4>
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
            </div>
            <div class="card-body">
              <form action="<?= site_url('peminjam/save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_user" value="<?= session('id_user'); ?>">

                <div class="form-group">
                  <label>Nama peminjam</label>
                  <input type="text" class="form-control" name="nama_peminjam">
                </div>

                <div class="form-group">
                  <div class="control-label">Status peminjam</div>
                  <div class="custom-switches-stacked mt-2">
                    <label class="custom-switch">
                      <input type="radio" name="status_peminjam" value="dosen" class="custom-switch-input" checked="">
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Dosen</span>
                    </label>
                    <label class="custom-switch">
                      <input type="radio" name="status_peminjam" value="mahasiswa" class="custom-switch-input">
                      <span class="custom-switch-indicator"></span>
                      <span class="custom-switch-description">Mahasiswa</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>NIP / NIM</label>
                  <input type="text" class="form-control" name="no_identitas">
                </div>

                <div class="form-group">
                  <label>No. Telepon</label>
                  <input type="text" class="form-control" name="no_telepon">
                </div>

                <div class="form-group">
                  <label class="form-label">Asal peminjam</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="asal_peminjam" value="luar prodi" class="selectgroup-input eksternal" >
                      <span class="selectgroup-button" checked>Luar Prodi</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="asal_peminjam" value="dalam prodi" class="selectgroup-input internal" >
                      <span class="selectgroup-button">Dalam Prodi</span>
                    </label>
                  </div>
                </div>

                <div class="section_upload">
                  <div class="form-group">
                    <label>Upload Surat Pengantar <span style="color: red; font-size: 10px;">* Khusus Luar Prodi</span></label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="uploadFile" name="surat_pengantar">
                      <label class="custom-file-label p-0 px-3" for="customFile">Pilih File</label>
                    </div>
                  </div>
                  <div class="form-group section_download">
                    <label>Contoh Surat Pengantar</label> <br>
                    <a href="<?= base_url('peminjam/contoh'); ?>" download class="d-inline-block btn btn-sm btn-outline-primary">Download</a>
                  </div>
                </div>

            </div>
          </div>
        </div>
        <!-- form ruangan -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Form Ruangan</h4>
            </div>
            <div class="card-body">

              <div class="form-group">
                <label>Pilih Lab beserta jam</label>
                <select class="form-control py-0" name="id_ruangan">
                  <?php foreach ($ruangan as $row): ?>
                    <option value="<?= $row->id_ruangan; ?>"><?= $row->nama_ruangan; ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group row">
                <div class="col-6">
                  <label>Kapasitas <span style="color: red; font-size: 12px;">* Max 30</span></label>
                  <input type="number" class="form-control" name="kapasitas">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-6">
                  <label>Tanggal Awal Pinjam</label>
                  <input type="date" class="form-control datepicker" name="tgl_awal_pinjam">
                </div>
                <div class="col-6">
                  <label>Tanggal Akhir Pinjam</label>
                  <input type="date" class="form-control datepicker" name="tgl_akhir_pinjam">
                </div>
              </div>

              <div class="form-group">
                <label>Kegiatan</label>
                <textarea class="form-control" style="height: 100px" name="kegiatan"></textarea>
              </div>
            </div>

            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary btn-lg">Kirim Form</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->endSection() ?>