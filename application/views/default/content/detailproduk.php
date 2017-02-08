  <section>
  <div class="container">
        <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li class="active">Detail Produk</li>
        </ol>
      </div>
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
                    <h2 class="title text-center">Detail Produk</h2>
                    <h4>Kategori: <a href=''>
                    <?php echo $kasur->jenis_nama ?></a></h4>
                  <p>Nama Produk : <?php echo $kasur->kasur_merk ?></p>
                    <center>
                      
              <div class="product-image-wrapper">
                <div class="single-products">
                  <div class="productinfo2 text-center">
                         <img src='<?php echo base_url()."assets/images/kasur/kecil_".$kasur->kasur_gambar;?>'>
                     <h2 class="harga">Harga : Rp.<?php echo format_rupiah($kasur->kasur_harga) ?><br><span>Ukuran :   <?php echo $kasur->ukuran_dimensi ?></span></h2>

                  </div>
                     </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li>
                     <a href="<?php echo base_url()?>produk/add_to_cart/<?php echo $kasur->kasur_id;?>" class="btn btn-danger add-to-cart"><i class="fa fa-eye"></i>Add to Chart</a>
                     </li>
                  </ul>
                </div>
              </div>
              
            </center>
        
                 <h2 class="title text-center">Produk Lainnya</h2>
          <?php
                                    $jml_data = $this->ADM->count_all_kasur();
                                    if ($jml_data > 0) {
                                        foreach ($this->ADM->grid_all_kasur('', 'kasur_waktu', 'DESC', 3, '', '', '') as $row){
                                        ?>
             <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                           
                                <div class="productinfo text-center">
                                    <img src='<?php echo base_url()."assets/images/kasur/kecil_".$row->kasur_gambar;?>'>
                                    <h2 class="harga">Rp.<?php echo format_rupiah($row->kasur_harga);?></h2>
                                    <p><?php echo $row->kasur_merk;?></p>
                                    <a href="" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Detail Produk</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2 class="harga">Rp.<?php echo $row->kasur_harga;?>,00</h2>
                                        <p><?php echo $row->kasur_merk;?></p>
                                        <a href="<?php echo base_url()?>produk/detailproduk/<?php echo $row->kasur_id;?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Detail Produk</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li>
                                        <a href="<?php echo base_url()?>produk/add_to_cart/<?php echo $kasur->kasur_id;?>" class="btn btn-danger add-to-cart"><i class="fa fa-eye"></i>Add to Chart</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
         <?php
                                        } 
                                    } else {
                                    ?>
                                    <center><h4>Data Tidak Ada></h4></center>
                                <?php } ?>
   
      </div>

      </div>
    </div>
  </div>
</section>
  <div class="end"></div>
