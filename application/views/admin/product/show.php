<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script type="text/javascript">
$(function() {
	$('.price_format').priceFormat({
      prefix: '',
      thousandsSeparator: '.',
      clearOnEmpty: true,
      centsLimit: 0,
      limit:9
    });
  });
</script>
			<div class="content-wrapper">
				<section class="content-header">
					<?php echo $pagetitle; ?>
					<?php echo $breadcrumb; ?>
				</section>

				<section class="content">
					<div class="row">
						<div class="col-md-4">
							 <div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">Foto Produk</h3>
								</div>
								<div class="box-body">
										<?php foreach ($product_attachment as $prod_att) { ?>
											<?php if ($prod_att->main_file==1): ?>
												<img id="xzoom-fancy" 
												src="<?php echo base_url('upload/product/'.$prod_att->filename);?>" 
												xoriginal="<?php echo base_url('upload/product/'.$prod_att->filename);?>" 
												class="xzoom4 img-responsive img-rounded">
											<?php endif ?>
										<?php } ?>
<br>
									<div class="xzoom-thumbs">
										<?php foreach ($product_attachment as $prod_att) { ?>
											 <a href="<?php echo base_url('upload/product/'.$prod_att->filename);?>"> 
											 	<img class="xzoom-gallery4 " 
											 	src="<?php echo base_url('upload/product/thumbnail/'.$prod_att->filename);?>"  
											 	xpreview="<?php echo base_url('upload/product/'.$prod_att->filename);?>" >
											 </a>
										<?php } ?>
									</div>
								</div>
							</div>
						 </div>
						 <div class="col-md-8">
 							 <div class="box">
 								<div class="box-header with-border">
 									<h3 class="box-title">Deskripsi Produk</h3>
 								</div>
 								<div class="box-body wrapword">
									<h2><?php echo $one_product->name ?></h2>
									<h2><b><?php echo $one_product->symbol ?>. <span class="price_format"><?php echo $one_product->price ?></span></b></h2>
									<h4><b>Deskripsi Produk :</b></h4>
									<?php echo $one_product->description ?>
									<h4><b>Variasi Produk :</b></h4>
											<ul><?php foreach ($group_variation_product as $grup_v_p): ?>
														<li><?php echo $grup_v_p->name ?> :
															<ul>
																<?php foreach ($variation_product as $v_prod): ?>
																	<?php if ($v_prod->variation_id == $grup_v_p->variation_id): ?>
																			<li><?php echo $v_prod->value ?></li>
																	<?php endif; ?>
																<?php endforeach; ?>
															</ul>
														</li>
												<?php endforeach; ?>
											</ul>
									<h4><b>SKU : <?php echo $one_product->sku ?></b></h4>
									<h4><b>Kategori :&nbsp;<?php foreach ($category_product as $key => $c_p) {$cp[$key] = $c_p->name;} ?> <?php echo implode(", ", $cp) ?></b></h4>
									<h4><b>Harga Grosir : </b></h4>
										<table class="table table-condensed table-striped" style="width:50%;">
											<tr>
												<td>Min.</td><td>Maks.</td><td>Harga</td>
											</tr>
											<?php foreach ($wholesale_product as $wp): ?>
												<tr>
													<td><?php echo $wp->min_qty ?></td>
													<td><?php echo $wp->max_qty ?></td>
													<td>Rp. <span class="price_format"><?php echo $wp->price ?></span></td>
												</tr>
											<?php endforeach; ?>
										</table>
										<h4><b>Kombinasi Produk Lainnya : </b></h4>
												<p>Beli produk dalam daftar ini, maka akan mendapatkan harga spesial :</p>
											<table class="table " style="">
											<?php foreach ($combine_product as $comb_p): ?>
															<tr>
																<td><img src="<?php echo base_url('upload/product/'.$comb_p->filename);?>" alt="" class="profile-user-img img-responsive img-circle"></td>
																<td style="font-size:16px;"><b><?php echo $comb_p->name ?></b></td>
																<td style="font-size:16px;">Harga Spesial Untuk <?php echo ucwords($comb_p->name) ?> Menjadi <b><?php echo $one_product->symbol ?>. <?php echo $comb_p->price_combine ?></b></td>
															</tr>
											<?php endforeach; ?>
											</table>
										<h4><b>Video Produk : </b></h4>
										<?php if (!!$one_product->video_product) {
											$url = $one_product->video_product;
										preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
											$youtube_id = $match[1]; ?>
										<iframe width="420" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id ?>?autoplay=0&output=embed" frameborder="0" allowfullscreen> </iframe>
									<?php } ?>
 								</div>
 							</div>
 						 </div>
					</div>
				</section>
			</div>
