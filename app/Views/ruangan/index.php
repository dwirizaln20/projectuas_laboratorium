<?= $this->extend('layout/default'); ?>

<?= $this->section('content'); ?>
<div class="main-content">
<section class="section">
  <div class="section-header">
    <h1>Ruangan</h1>
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
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Tambah Data Ruangan</h4>
          </div>
          <form action="<?= site_url('ruangan/create'); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="card-body">
              <div class="form-group">
                <label for="nama_ruangan">Nama Ruangan</label>
                <input type="text" class="form-control" name="nama_ruangan" autofocus>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>Data Ruangan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
              <thead>
                <tr>
                  <th style="width: 5%">#</th>
                  <th>Nama</th>
                  <th style="width: 25%;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($ruangan as $key => $row): ?>
                  
                <tr>
                  <td><?= ++$key; ?></td>
                  <td><?= $row->nama_ruangan; ?></td>
                  <td>
                    <a href="<?= site_url('ruangan/edit/' . $row->id_ruangan); ?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                    <form action="<?= site_url('ruangan/delete/') . $row->id_ruangan?>" class="d-inline" method="post">
                      <?= csrf_field(); ?>
                      <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
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
<?= $this->endSection(); ?>