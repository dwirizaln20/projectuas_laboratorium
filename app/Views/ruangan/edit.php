<?= $this->extend('layout/default') ?>

<?= $this->section('content'); ?>
<div class="main-content">
<section class="section">
  <div class="section-header">
  	<div class="section-header-back">
        <a href="<?= site_url('ruangan')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit ruangan</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
		  <div class="card-header">
		    <h4>Ubah Data ruangan</h4>
		  </div>
		  <div class="card-body">
		  	<form action="<?= site_url('ruangan/update/'). $ruangan->id_ruangan; ?>" method="POST">
		  		<?= csrf_field() ?>
			    <div class="form-row">
			      <div class="form-group col-md-6">
			        <label for="nama">Nama ruangan</label>
			        <input type="text" class="form-control" name="nama_ruangan" value="<?= old('nama_ruangan', $ruangan->nama_ruangan)?>">
			      </div>
			    </div>
			  </div>
			  <div class="card-footer">
			    <button class="btn btn-outline-primary" type="submit">Submit</button>
			  </div>
			</form>
		</div>
      </div>
    </div>

  </div>
</section>
</div>
<?= $this->endSection(); ?>