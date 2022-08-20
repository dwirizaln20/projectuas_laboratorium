<?php if (session('level') == "peminjam"): ?>
	<li class="menu-header">Dashboard</li>
	<li class="nav-item">
		<a href="<?= site_url('peminjam'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
	</li>
	<li class="menu-header">Menu Peminjam</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= site_url('peminjam/form_pinjam'); ?>"><i class="fas fa-fire"></i><span>Form Peminjaman</span></a>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Riwayat Peminjam</span></a>
		<ul class="dropdown-menu">
			<li><a class="nav-link" href="<?= site_url('peminjam/riwayat/acc'); ?>">Telah Disetujui</a></li> 
			<li><a class="nav-link" href="<?= site_url('peminjam/riwayat/verifikasi'); ?>">proses Verifikasi</a></li>
			<li><a class="nav-link" href="<?= site_url('peminjam/riwayat/ditolak'); ?>">Peminjaman Ditolak</a></li>
		</ul>
	</li>
<?php endif ?>

<?php if (session('level') == "laboran"): ?>
	<li class="menu-header">Dashboard</li>
	<li class="nav-item">
		<a href="<?= base_url(); ?>/laboran" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
	</li>
	<li class="menu-header">Menu Laboran</li>
	<li class="nav-item dropdown">
		<a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Riwayat Peminjam</span></a>
		<ul class="dropdown-menu">
			<li><a class="nav-link" href="<?= site_url('laboran/riwayat/acc'); ?>">Telah Disetujui</a></li> 
			<li><a class="nav-link" href="<?= site_url('laboran/riwayat/verifikasi'); ?>">proses Verifikasi</a></li>
			<li><a class="nav-link" href="<?= site_url('laboran/riwayat/ditolak'); ?>">Peminjaman Ditolak</a></li>
		</ul>
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-fire"></i> <span>Manajemen Lab</span></a>
		<ul class="dropdown-menu">
			<li><a class="nav-link" href="<?= site_url('ruangan'); ?>">Ruangan</a></li> 
			<li><a class="nav-link" href="<?= base_url('laboran/jadwal'); ?>">Daftar Jadwal</a></li> 
		</ul>
	</li>
<?php endif ?>


<?php if (session('level') == "kalab"): ?>
	<li class="menu-header">Dashboard</li>
	<li class="nav-item">
		<a href="<?= base_url(); ?>/kalab" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
	</li>
	<li class="menu-header">Menu Kepala Lab</li>
	<li class="nav-item">
		<a href="<?= base_url(); ?>/kalab/laporan" class="nav-link"><i class="fas fa-fire"></i><span>Laporan Lab</span></a>
	</li>
	<li class="nav-item">
		<a href="<?= base_url(); ?>/kalab/jadwal" class="nav-link"><i class="fas fa-fire"></i><span>Laporan Jadwal</span></a>
	</li>
<?php endif ?>

