<ul class="nav nav-tabs no-print">
	<li class="<?php if ($this->uri->segment(3)=='daftartransaksi'){echo 'active'; } ?>"><?php echo anchor('admin/belanjabarang/daftartransaksi', 'Daftar Transaksi'); ?></li>
	<li class="<?php if ($this->uri->segment(3)=='bysuplier' or $this->uri->segment(3)=='bysuplierdetail'){echo 'active'; } ?>"><?php echo anchor('admin/belanjabarang/bysuplier', 'Berdasarkan Suplier'); ?></li>
	<li class="<?php if ($this->uri->segment(3)=='bybarang'){echo 'active'; } ?>"><?php echo anchor('admin/belanjabarang/bybarang', 'Berdasarkan Barang'); ?></li>
</ul>