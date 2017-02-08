 <section>
	<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>">Home</a></li>
				  <li class="active">Cara Pembelian</li>
				</ol>
			</div><!--/breadcrums-->
		<div class="row">
			<div class="col-sm-3">
				         <?php 
                    if ($boxkategori == TRUE) {
                        $this->load->view('default/box/box-kategori');
                    } 
                    if ($boxkeranjang == TRUE) {
                        $this->load->view('default/box/box-keranjang');
                    } 
                     if ($boxinformasi == TRUE) {
                        $this->load->view('default/box/box-informasi');
                    } 
                  ?>
</div>
			<div class="col-sm-9 padding-right">
       
                    <h2 class="title text-center">Cara Pembelian</h2>
                    
                   1. Buka
                   <br>
                   2. Buka
		</div>
	</div>
</section>
  <div class="end"></div>
  