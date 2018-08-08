<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Ujian Nasional Berbasis Komputer 2017/2018</title>

    <script>var base_url = '/';</script>
    <style type="text/css"> 
@font-face{font-family:MyBarcode;src:url(../fonts/barcode.woff)}*{margin:0;padding:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}body{background:#ddd;font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;font-size:11px}
  .page{ 
  		position:relative; width:21cm;min-height:29cm;page-break-after:always;margin:0.5cm auto;background:#FFF;padding:1.5cm;box-shadow:0 2px 10px rgba(0,0,0,0.3);-webkit-box-sizing:initial;-moz-box-sizing:initial;box-sizing:initial;page-break-after:always;}.page *{font-family:arial;font-size:11px}.page-landscape{position:relative;width:29.7cm;min-height:21cm;page-break-after:always;margin:0.5cm;background:#FFF;padding:1.5cm;box-shadow:0 2px 10px rgba(0,0,0,0.3);-webkit-box-sizing:initial;-moz-box-sizing:initial;box-sizing:initial;page-break-after:always}.page-landscape *{font-family:arial;font-size:11px}.footer{position:absolute;bottom:1.3cm;left:1.5cm;right:1.5cm;width:auto;height:30px}.kanan{float:right}.barcode{font-family:MyBarcode}.it-grid{background:#FFF;border-collapse:collapse;border:1px solid #000}.it-grid th{color:#000;border:1px solid #000;border-top:1px solid #000;background:#C4BC96;padding:3px;border:1px solid #000}.it-grid tr:nth-child(even){background:#f8f8f8}.it-grid td{padding:3px;border:1px solid #000}.seri{font-family:'Lucida Handwriting'}.it-cetak td{padding:6px 5px}h1{font-weight:normal}h2{font-weight:normal}h3{font-weight:normal}h4{font-weight:normal}h5{font-weight:normal}h6{font-weight:normal}table{border-collapse:collapse;page-break-inside:auto}td{padding:3px}.f14{font-size:14pt}.f12{font-size:12pt}.line-bottom{border-bottom:1px solid black}.detail{margin-top:10px;margin-bottom:10px}.detail td{padding:5px;font-size:12px}.detail span{border-bottom:1px solid black;display:inline-block;font-size:12px}.cetakan{font-size:14px;line-height:1.5em}.cetakan *{font-size:14px;line-height:1.5em}.cetakan span{border-bottom:1px solid black;display:inline-block}.full{width:100%}nip{display:inline-block;width:130px}a{text-decoration:none;color:#006600}ol{margin-left:30px}ol>li{padding:10px}tr{page-break-inside:avoid;page-break-after:auto}thead{display:table-row-group}tfoot{display:table-row-group}.table th,.table td{padding:5px}.table tbody tr:nth-child(even){background:#EEE}.table thead{background:#ccc}@media print{body{background:#fff;font-family:'Times New Roman',Times,serif;font-size:12pt}div{font-family:'Times New Roman',Times,serif;font-size:12pt}td{font-family:'Times New Roman',Times,serif;font-size:12pt}p{font-family:'Times New Roman',Times,serif;font-size:12pt}.page{height:10cm;padding:0.7cm;box-shadow:none;margin:0}@page{size:A4;margin:0;-webkit-print-color-adjust:exact}.page-landscape{height:10cm;padding:0.7cm;box-shadow:none;margin:0}.footer{bottom:0.7cm;left:0.7cm;right:0.7cm}}
</style>

    <link rel="icon" type="image/png" href="/assets/img/logo.png">
</head>
<body>

	<?php for ($pg=1; $pg <= $halaman; $pg++) { ?>
		<div class="page">
			<?php if ($pg==1): ?>
				<table width="100%">
				<tbody><tr>
					<td width="100"><img src="<?php echo base_url('assets/img/logo.png') ?>" height="75"></td>
					<td>
						<center>
							<strong class="f12">
								KOPERASI UNIT DESA BAHAR 12 <br>
								DAFTAR TRANSAKSI BELANJA BARANG PER SUPLIER <br>
								PERIODE : 
							</strong>
						</center></td>
				</tr>
			</tbody></table><br><hr><hr><br>
			<?php endif ?>
					
			<?php 
				$mulai = ($pg>1) ? ($pg * $maks_baris) - $maks_baris : 0;
				echo $mulai;
				$detail =& get_instance();
				$detail->load->model('transaction_model');
				$result = $detail->transaction_model->get_transaksi_bayar_detail_multi_id_transaksi_limit($id_trans, $mulai,$maks_baris);
			?>
			<?php foreach ($result->result() as $rs_dt): ?>
				<table>
					<tr>
						<td><?php echo $rs_dt->id_transaksi_belanja ?></td>
					</tr>
				</table>
			<?php endforeach ?>


			<?php if ($pg==$halaman): ?>
				<div class="footer" >
				<table width="100%" height="30">
				<tbody><tr>
					<td width="25px" style="border:1px solid black"></td>
					<td width="5px">&nbsp;</td>
					<td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">KOPERASI UNIT DESA BAHAR 12 - @ <?php echo date('Y') ?></td>
					<td width="5px">&nbsp;</td>
					<td width="25px" style="border:1px solid black"></td>
				</tr>
				</tbody></table>
			</div>
			<?php endif ?>
		</div>
	<?php } ?>		
    
</body></html>