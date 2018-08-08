<html lang="en"><head>
    <meta charset="UTF-8">

    <script>var base_url = '/';</script>
    <style type="text/css"> 
@font-face{font-family:MyBarcode;src:url(../fonts/barcode.woff)}*{margin:0;padding:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}body{background:#ddd;font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;font-size:11px}
  .page{ 
  		position:relative; width:21cm;min-height:29.7cm;max-height:29.7cm;page-break-after:always;margin:0.9cm auto;background:#FFF;padding:1cm;box-shadow:0 2px 10px rgba(0,0,0,0.3);-webkit-box-sizing:initial;-moz-box-sizing:initial;box-sizing:initial;page-break-after:always;}
  	.page *{font-family:arial;font-size:10pt}
  .it-grid{background:#FFF;border-collapse:collapse;border:1px solid #000}
  .it-grid th{color:#000;border:1px solid #000;border-top:1px solid #000;background:#C4BC96;padding:3px;border:1px solid #000}
  .it-grid tr:nth-child(even){background:#fff}.it-grid td{padding:3px;border:1px solid #000}.seri{font-family:'Lucida Handwriting'}.it-cetak td{padding:4px 5px}h1{font-weight:normal}h2{font-weight:normal}h3{font-weight:normal}h4{font-weight:normal}h5{font-weight:normal}h6{font-weight:normal}table{border-collapse:collapse;page-break-inside:auto}td{padding:3px}.f14{font-size:14pt}.f12{font-size:12pt}.f11{font-size:11pt}.line-bottom{border-bottom:1px solid black}.detail{margin-top:1px;margin-bottom:1px}.detail td{padding:5px;font-size:11pt}.detail span{border-bottom:1px solid black;display:inline-block;font-size:11pt}.cetakan{font-size:14px;line-height:1.5em}.cetakan *{font-size:14px;line-height:1.5em}.cetakan span{border-bottom:1px solid black;display:inline-block}.full{width:100%}nip{display:inline-block;width:130px}a{text-decoration:none;color:#006600}ol{margin-left:30px}ol>li{padding:10px}tr{page-break-inside:avoid;page-break-after:auto}thead{display:table-row-group}tfoot{display:table-row-group}.table th,.table td{padding:5px}.table tbody tr:nth-child(even){background:#EEE}.table thead{background:#ccc}
  	@media print{
  		body{background:#fff;font-family:'Times New Roman',Times,serif;font-size:14pt}
  		div{font-family:'Times New Roman',Times,serif;font-size:12pt}
  		td{font-family:'Times New Roman',Times,serif;font-size:12pt}
  		p{font-family:'Times New Roman',Times,serif;font-size:12pt}
  		.page{box-shadow:none;margin:0.3cm}
  		@page{
  			size:A4;
  			margin-left:0cm;
  			margin-bottom:0cm;
  			margin-right:0cm;
  			margin-top:0cm;
  		}
  		.page-landscape{height:10cm;padding:0.2cm 0.9cm;box-shadow:none;margin:0}

</style>

    <link rel="icon" type="image/png" href="/assets/img/logo.png">
</head>
<body>
<?php if ($empty=='n'){ ?>
	<?php $total_belanja_perperiode=0; ?>
	<?php $no_header=1; foreach ($detail_perpage as $key => $value): ?>
		<div class="page">
			<?php if ($key==1): ?>
				<table width="93%">
				<tbody><tr>
					<td width="60"><img src="<?php echo base_url('assets/img/logo.png') ?>" height="75"></td>
					<td>
						<center>
						<strong class="f14">
								<?php echo strtoupper($kud->nama_kud) ?><br><br>
						</strong>
							<strong class="f12">
									Alamat : <?php echo $kud->alamat ?>
							</strong>
						</center></td>
				</tr>
			</tbody></table><hr><hr><br>
			<table width="100%">
				<tr align="center">
					<td><strong class="f11">DAFTAR TRANSAKSI BELANJA BARANG BERDASARKAN SUPLIER</strong></td>
				</tr><tr align="center">
					<td><strong class="f11">PERIODE : <?php echo date_indo($tgl_mulai) ?> - <?php echo date_indo($tgl_selesai) ?></strong></td>
				</tr>
			</table><br>
			<table class="detail" style="margin-bottom: 8px">
				<tr>
					<td width="20px">Nama Suplier</td><td>:</td><td><span style="width:380px"><?php echo $header[0]['nama_suplier'] ?></span></td>
				</tr>
				<tr>
					<td>Alamat Suplier</td><td>:</td><td><span style="width:380px"><?php echo $header[0]['alamat'] ?></span></td>
				</tr>
				<tr>
					<td>No. Telp /No. HP</td><td>:</td><td><span style="width:380px"><?php echo $header[0]['no_telp'] ?></span></td>
				</tr>
			</table>
			<?php endif ?>
			<table class="it-grid it-cetak" width="100%">

				<?php $no_detail=1;foreach ($value as $kk => $v_detail){ ?>
					<tr>
						<?php if (!$v_detail['id_detail']){ ?>
							<td colspan="3" style="font-weight: bold;border-left-color:#fff; border-right-color:#fff;border-top-color:#fff;padding-top:14px;padding-bottom: 4px;padding-left: 5px;"><?php echo $no_header ?>. ID Transaksi #<?php echo $v_detail['id_transaksi_belanja']; ?>, Tanggal Transaksi : <?php echo date_indo($v_detail['tanggal']) ?></td>
						<?php $no_header++; $no_detail=1;}
						if ($v_detail['id_detail']=='%'){ ?>
							<td style="background-color: #f8f8f8;text-align: center;width: 62%"><b>Nama Barang</b></td>
							<td style="background-color: #f8f8f8;text-align: center;font-weight: bold;">Harga Beli</td>
							<td style="background-color: #f8f8f8;text-align: center;font-weight: bold;">Qty</td>
							<td style="background-color: #f8f8f8;text-align: center;font-weight: bold;">Subtotal</td>
						<?php  }
						if ($v_detail['id_detail']=='x') { ?>
							<td style="background-color: #f8f8f8;" colspan="3" ><b>Total Pembayaran Belanja Barang</b> <?php //echo $kk ?></td>
							<td style="background-color: #f8f8f8;width: 16%"><b>Rp. <?php echo $this->cart->format_number($v_detail['total']) ?></b></td>
						<?php $total_belanja_perperiode=$total_belanja_perperiode+ $v_detail['total']; }

						if($v_detail['id_detail']>=1){ ?>
						<td>&nbsp;&nbsp;<?php echo $no_detail ?>.&nbsp;<?php echo $v_detail['nama_barang'];?></td>
						<td>Rp. <?php echo $this->cart->format_number($v_detail['harga_beli']) ?></td>
						<td align="center"><?php echo $this->cart->format_number($v_detail['qty'] );?></td>
						<td>Rp. <?php echo $this->cart->format_number($v_detail['total']); ?></td>
					<?php $no_detail++; } ?>
					</tr>
				<?php } ?>
			</table>


			<?php if ($key == count($detail_perpage)): ?><br>
				<span style="font-size: 11pt;font-weight: bold;">
					Total Pembayaran Belanja Barang Pada Periode Ini = Rp. <?php echo $this->cart->format_number($total_belanja_perperiode) ?>
				</span>
				<br>
				<table width="100%">
					<tr>
						<td>&nbsp;</td>
						<td width="40%">&nbsp;</td>
						<td width="30%">
							<?php echo $kud->laporan_tpt_terbit ?>, <?php echo date_indo(date('Y-m-d')) ?><br>
							Mengetahui,<br>
							<?php if (!!$kud->laporan_nama_ttd_right): ?>
								<?php echo $kud->laporan_jabatan_right ?> <br>
								<br><br><br><br><br>
								<u>( <?php echo $kud->laporan_nama_ttd_right ?> )</u>
							<?php endif ?>
							</td>
					</tr>
				</table>
			<?php endif ?>
				<div class="footer" style="position:absolute;bottom: 0.3cm;left:1cm;right:1cm;width:auto;">
				
			<table width="100%">
				<tbody><tr>
					<td style="border:1px solid black;font-weight:bold;font-size:11px;text-align:center;width: 85%" ><?php echo $kud->nama_kud ?> - @ <?php echo date('Y') ?></td>
					<td>&nbsp;</td>
					<td style="border:1px solid black;font-weight:bold;font-size:11px;text-align:center;">Halaman <?php echo $key ?>/<?php echo count($detail_perpage) ?></td>
				</tr>
				</tbody></table>
			</div>
			
		</div>
	<?php endforeach ?>
<?php }else{ ?>
	<div class="page">
		<table width="100%" style="font-size: 14pt;text-align: center;">
			<tr>
				<td style="font-size: 14pt;">Data Dengan Filter Yang Telah Dipilih Kosong.</td>
			</tr>
		</table>
	</div>
<?php } ?>
</body>

</html>