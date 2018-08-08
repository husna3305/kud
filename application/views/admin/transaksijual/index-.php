<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content-wrapper">
	<section class="content-header">
		<?php echo $pagetitle; ?>
		<?php echo $breadcrumb; ?>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
			<div class="box box-primary">
            <div class="box-body">
             <table class="table table-condensed table-bordered table-striped">
             	<thead style="font-weight: bold;font-size: 16px;background-color: #5ca1c7;color: white;">
             		<tr>
	             		<th style="text-align: center;"><i class="fa fa-times"></i></th>
	             		<th style="text-align: center;">Nama Barang</th>
	             		<th style="text-align: center;">Qty</th>
	             		<th style="text-align: center;">Harga</th>
	             		<th style="text-align: center;">Subtotal</th>
	             	</tr>
             	</thead>
             	<tbody>
             		<tr>
             			<td style="text-align: center;"><a href=""><i class="fa fa-times"></i></a></td>
             			<td>Coba Coba Coba Coba Coba Coba</td>
             			<td>1</td>
             			<td>2000000</td>
             			<td>20000000</td>
             		</tr>
             	</tbody>
             </table>

            </div>
            <!-- /.box-body -->
          </div>
			</div>
			<div class="col-md-6">
				<div class="box box-primary" style="margin-bottom: 5px">
					<div class="box-body">
						<div class="col-md-12"style="padding:5px; border:dotted 1px; white-space:nowrap; overflow-x:auto;">
							<button class="btn btn-info" style="margin-right: 10px; ">Semua</button>
							<?php foreach ($kategori->result() as $r_k): ?>
								<?php if ($r_k->parent_id==0): ?>
									<button class="btn btn-info" style="margin-right: 10px; "><?php echo $r_k->nama_kategori ?></button>
								<?php endif ?>
								<?php foreach ($kategori->result() as $ktg): ?>
									<?php if ($ktg->parent_id==$r_k->id_kategori): ?>
										<button class="btn btn-info" style="margin-right: 10px; ">>>&nbsp;<?php echo $ktg->nama_kategori ?></button>
									<?php endif ?>
								<?php endforeach ?>
							<?php endforeach ?>
						</div>
					</div>
				</div>
				<div class="box box-info" style="padding-top: 0px;min-height: 400px">
					<div class="box-body">
						<div class="col-md-12">
							<div class="form-group" ">
								<input type="" name="" class="form-control" placeholder="Cari Barang Berdasarkan Nama">
							</div>
						</div>
						<div id="show_barang">
							
							
						<div class="col-md-6" style="padding: 3px;">
							<a href="">
								<div class="info-box bg-green" style="min-height: 0%;margin-bottom: 7px;">
						            <div class="info-box-content" style="margin-left: 2px">
						              <span class="info-box-text" style="font-size: 13px">Cob cobaCob cobaCob cobaCob cobaCob coba</span>
						              <span class="info-box-number" style="font-size: 14px">Kategori :</span>
						              <div class="progress">
						                <div class="progress-bar" style="width: 100%"></div>
						              </div>
						                  <span class="progress-description">
						                    70% Increase in 30 Days
						                  </span>
						            </div>

						         </div>
					     	</a>
					     	<!-- Untuk Transaksi Penjualan
					     	<a href="">
								<div class="info-box bg-green" style="min-height: 0%;margin-bottom: 7px;">
						            <div class="info-box-content" style="margin-left: 2px">
						              <span class="info-box-text" style="font-size: 13px">Cob cobaCob cobaCob cobaCob cobaCob coba</span>
						              <span class="info-box-number" style="font-size: 16px">41,410</span>

						              <div class="progress">
						                <div class="progress-bar" style="width: 100%"></div>
						              </div>
						                  <span class="progress-description">
						                    70% Increase in 30 Days
						                  </span>
						            </div>
						         </div>
					     	</a> -->
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>