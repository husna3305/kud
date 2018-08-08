<ul class="nav nav-tabs no-print">
	<li class="<?php if ($this->uri->segment(3)=='daftartransaksi'){echo 'active'; } ?>"><?php echo anchor('admin/transaksijual/daftartransaksi', 'Daftar Transaksi'); ?></li>
	<li class="<?php if ($this->uri->segment(3)=='bykelompoktani' or $this->uri->segment(3)=='bykelompoktanidetail'){echo 'active'; } ?>"><?php echo anchor('admin/transaksijual/bykelompoktani', 'Berdasarkan Kelompok Tani'); ?></li>
	<li class="<?php if ($this->uri->segment(3)=='bykonsumen' or $this->uri->segment(3)=='bykonsumendetail'){echo 'active'; } ?>"><?php echo anchor('admin/transaksijual/bykonsumen', 'Berdasarkan Konsumen'); ?></li>
	<li class="<?php if ($this->uri->segment(3)=='bybarang'){echo 'active'; } ?>"><?php echo anchor('admin/transaksijual/bybarang', 'Berdasarkan Barang'); ?></li>
</ul>