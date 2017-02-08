<section>
	<div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li class="active">Pesanan</li>
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
  	  <h2 class="title text-center">Pesanan</h2>
      <!-- ========== Flashdata ========== -->
                    <?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php } else if ($this->session->flashdata('warning')) { ?>
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-check sign"></i><?php echo $this->session->flashdata('warning'); ?>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-warning sign"></i><?php echo $this->session->flashdata('error'); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <!-- ========== End Flashdata ========== -->
       <table class="table-keranjang" width="100%;">
          <tbody>
            <tr  class='tab_bg' align=center height=23>
        		  <th><span class='table'>No</span></th>
        		  <th><span class='table'>Tanggal Pesanan</span></th>
        		  <th><span class='table'>No.Invoice</span></th>
        		  <th><span class='table'>Total Pembayaran</span></th>
            </tr>
		  <?php  
		 	$no=1;
            $query = $this->db->query("SELECT * FROM invoices WHERE pelanggan_username='$pelanggan->pelanggan_username' ORDER BY invoices_id DESC");
            foreach ($query->result() as $row){ 
      ?>
			<tr class='tab_bg2' align=center>
				  <td><span class='table2'><?php echo $no; ?></td>
				  <td><span class='table2'><?php echo dateIndo1($row->invoices_date); ?></span></td>
				  <td><span class='table2'><b>#INVOICES-<?php echo $row->invoices_id; ?></b></span></td>
				  <td><span class='table2'>Rp.<?php echo number_format($row->invoices_subtotal,0,',','.'); ?></span></td>
			</tr>
		  <?php $no++; } ?>
  </tbody>
  </table>
  </div>
</div>
</div>
</div>
</div>
</section>
<div class="end"></div>