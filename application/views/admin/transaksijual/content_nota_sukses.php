<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nota Transaksi Penjualan Barang
        <small>#<?php echo $transaksi_header->id_transaksi_penjualan ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaksi Penjualan</a></li>
        <li><a href="#">Daftar Transaksi</a></li>
        <li class="active">Nota Transaksi Penjualan Barang</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-archive"></i> Nota Transaksi Penjualan Barang
            <small class="pull-right">Tanggal : <?php echo $transaksi_header->tanggal ?>, Waktu : <?php echo $transaksi_header->waktu ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          Data Pembeli
          <address>
            <strong><?php echo $transaksi_header->nama_kelompok_tani ?></strong><br>
            <?php echo $transaksi_header->alamat ?><br>
            <?php echo $transaksi_header->no_telp ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col col-sm-offset-2">
          <b>#<?php echo $transaksi_header->id_transaksi_penjualan ?></b><br>
          <br>
          Tanggal Transaksi Belanja : <?php echo $transaksi_header->tanggal ?> <?php echo $transaksi_header->waktu ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $qty = 0; $subtotal=0;$total=0; foreach ($transaksi_detail as $td): ?>
              <tr>
                <td><?php echo $td->nama_barang ?></td>
                <td><?php echo $td->root_kategori ?><?php if ($td->parent<>0): ?>,&bsp;
                <?php endif ?> <?php echo $td->nama_kategori ?></td>
                <td><?php echo $this->cart->format_number($td->qty) ?></td>
                <td>Rp. <?php echo $this->cart->format_number($td->harga_jual_tunai) ?></td>
                <td>Rp. <?php $subtotal=$td->qty*$td->harga_jual_tunai ?><?php echo $this->cart->format_number($subtotal); ?></td>
              </tr>
              <?php $qty = $qty+$td->qty;
                $total = $total+$subtotal;
              ?>
            <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-offset-7 col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
              <tr>
                <th style="width:50%">Total Jumlah Barang:</th>
                <td><?php echo $this->cart->format_number($qty) ?></td>
              </tr>
              <tr>
                <th style="width:50%">Total Belanja Barang:</th>
                <td>Rp. <?php echo $this->cart->format_number($total) ?></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button class="btn btn-default" onclick="cetak()"><i class="fa fa-print"></i> Cetak</button>
           <button type="button" class="btn btn-success pull-right" id="btn_daftartransaksi"><i class="fa fa-list"></i> Daftar Transaksi
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Simpan PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <script>
function cetak() {
    window.print();
}
$('#btn_daftartransaksi').click(function(){
  window.location = "<?php echo site_url('admin/transaksijual/daftartransaksi') ?>";
})
</script>