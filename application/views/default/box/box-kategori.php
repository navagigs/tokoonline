<div class="left-sidebar">
	<h2>Jenis Kategori</h2>
	<div class="panel-group category-products" id="accordian">
		<div class="panel panel-default">
			<div class="panel-heading">
			<?php
            	$jml_data = $this->ADM->count_all_jenis();
				if ($jml_data > 0) {
                    foreach($this->ADM->grid_all_jenis('*', 'jenis_nama', 'DESC', $jml_data, '', '', '') as $row) {
		            ?>
					<h4 class="panel-title">
						<a href="<?php echo base_url();?>produk/detailkategori/<?php echo $row->jenis_id;?>"><?php echo $row->jenis_nama;?><span class='pull-right'><i class="fa fa-angle-right"></i></span></a>
					</h4>
				   <?php
                   } 
	            } else {
                ?>
                    <h4 class="panel-title"><a href="">Data Tidak Ada></a></h4>
            <?php } ?>
			</div>
		</div>
	</div>
	<div class="brands_products">
		<a href="<?php echo site_url();?>produk">
			<button class="btn btn-default btn-block">Lihat Semua Produk</button>
		</a>
	</div>
</div>

