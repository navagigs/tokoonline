<!-- Include More Css For This Content -->
<link href="<?php echo base_url();?>templates/admin/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3><?php echo $breadcrumb; ?></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li class="active"><?php echo $breadcrumb; ?></li>
	</ol>	
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="block-flat">
                <div class="content">
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
                    <!-- ========== Button ========== -->
                    <form action="" method="post" id="form">
                        <div class='btn-navigation'> 
                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>admin/kasur/tambah"><i class="fa fa-plus-circle"></i> Tambah Kasur</a>
                            </div>  
                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>admin/kasur"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='btn-search'>Cari Berdasarkan :</div>
                            <div class='col-md-3 col-sm-12'>
                                <div class='button-search'><?php array_pilihan('cari', $berdasarkan, $cari);?></div>
                            </div>
                            <div class='col-md-3 col-sm-12'>
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="<?php echo $q;?>"/>
                                    <span class="input-group-btn">
                                        <button type="submit" name="kirim" class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- ========== End Button ========== -->
                    <!-- ========== Table ========== -->
                    <div class="table-responsive">
                        <table class="hover">
                            <thead class="primary-emphasis">
                                <tr>
    	                            <th width="30">#</th>
                                    <th>MERK</th>
                                    <th width="200">JENIS</th>
                                    <th width="200">UKURAN</th>
                                    <th width="200">HARGA</th>
                                    <th width="130">TANGGAL</th>
                                    <th width="120">AKSI</th>
	                           </tr>
                            </thead>
                            <tbody>
                                <?php 
	                            $i	= $page+1;
	                            $like_kasur[$cari]	= $q;
                            if ($jml_data > 0){
	                            foreach ($this->ADM->grid_all_kasur('', 'kasur_waktu', 'DESC', $batas, $page, '', $like_kasur) as $row){
	                            ?>
                                <tr>
    	                            <td align="center"><?php echo $i;?></td>
                                    <td><?php echo $row->kasur_merk;?></td>
                                    <td><?php echo $row->jenis_nama;?></td>
                                    <td><?php echo $row->ukuran_dimensi;?></td>
                                    <td>Rp.<?php echo format_rupiah($row->kasur_harga);?>,-</td>
                                    <td align="center"><?php echo dateIndo($row->kasur_waktu);?></td>
                                    <td align="center">
                                        <!-- ========== EDIT DETAIL HAPUS ========== -->
                                        <div class="btn-group">
								            <button type="button" class="btn btn-default btn-xs">Actions</button>
								            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
									            <span class="caret"></span>
									            <span class="sr-only">Toggle Dropdown</span>
								            </button>
								            <ul class="dropdown-menu pull-right" role="menu">
									            <li>
                                                    <a href="<?php echo site_url();?>admin/kasur/edit/<?php echo $row->kasur_id; ?>" title="Edit"><i class='fa fa-pencil'></i> Edit</a>
                                                </li>
									            <!--li>
                                                    <a data-toggle="modal" data-target="#mod-info" type="button"   href="<?php echo site_url();?>admin/kasur_detail/<?php echo $row->kasur_id;?>" rel="detail" title="Detail <?php echo $row->kasur_merk; ?>"><i class='fa fa-eye'></i> Detail</a>
                                                </li-->
									            <li>
                                                    <a href="javascript:;" data-id="<?php echo $row->kasur_id;?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $row->kasur_merk; ?>"><i class='fa fa-trash-o'></i> Hapus</a>
                                                </li>
								            </ul>
								        </div>	
                                        <!-- ========== End EDIT DETAIL HAPUS ========== -->
                                    </td>
                               </tr>
                                <?php
                                    $i++;
	                            } 
	                        } else {
                                ?>
                                <tr>
                                    <td colspan="6">Belum ada data!.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <!-- ========== End Table ========== -->
                    </div>
                    <div id='pagination'>
                        <div class='pagination-left'>Total : <?php echo $jml_data;?></div>
                        <div class='pagination-right'>
                            <ul class="pagination">
                                <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'admin/kasur/view', $id=""); }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- ========== Modal Detail ========== -->
<div class="modal fade" id="mod-info" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">                
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========== End Modal Detail ========== -->

<!-- ========== Modal Konfirmasi ========== -->
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:#d9534f;color:#fff">
				Apakah Anda yakin ingin menghapus data ini?
			</div>

			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" id="hapus-kasur">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>

		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->


<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3>Tambah <small><?php echo $breadcrumb; ?></small></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>admin/kasur"><?php echo $breadcrumb; ?></a></li>
        <li class="active">Tambah</li>
	</ol>	
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>admin/kasur/tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <input type="hidden" name="kasur_id" value="<?php echo $kasur_id;?>" />
                                    <tr>
                                        <td width="130">
                                            <label for="kasur_merk" class="control-label">Merk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="kasur_merk" id="kasur_merk" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan Merk"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="jenis_id" class="control-label">Jenis <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <?php $this->ADM->combo_box("SELECT * FROM jenis", 'jenis_id', 'jenis_id', 'jenis_nama', $jenis_id);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="ukuran_id" class="control-label">Ukuran <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <?php $this->ADM->combo_box("SELECT * FROM ukuran", 'ukuran_id', 'ukuran_id', 'ukuran_dimensi', $ukuran_id);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="kasur_harga" class="control-label">Harga <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="number" name="kasur_harga" id="kasur_harga" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan Harga"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="kasur_gambar" class="control-label">Gambar <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="kasur_gambar" id="kasur_gambar" required class="form-control btn-sm input-sm" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/kasur'"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<!-- ================================================== END TAMBAH ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<!-- Breadcrumb -->
<div class="page-head">
    <h3>Edit <small><?php echo $breadcrumb; ?></small></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>admin/kasur"><?php echo $breadcrumb; ?></a></li>
        <li class="active">Edit</li>
	</ol>	
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>admin/kasur/edit/<?php echo $kasur_id; ?>" method="post" enctype="multipart/form-data" parsley-validate novalidate>
                        <input type="hidden" name="kasur_id" value="<?php echo $kasur_id;?>" />
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y"> 
                                    <tr>
                                        <td width="130">
                                            <label for="kasur_merk" class="control-label">Merk <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="kasur_merk" type="text" required class="form-control input-sm" id="kasur_merk" value="<?php echo $kasur_merk;?>" size="80" maxlength="100" placeholder="Masukan Merk"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="jenis_id" class="control-label">Jenis <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <?php $this->ADM->combo_box("SELECT * FROM jenis ORDER BY jenis_nama ASC", 'jenis_id', 'jenis_id', 'jenis_nama', $jenis_id);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="ukuran_id" class="control-label">Ukuran <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <?php $this->ADM->combo_box("SELECT * FROM ukuran ORDER BY ukuran_dimensi ASC", 'ukuran_id', 'ukuran_id', 'ukuran_dimensi', $ukuran_id);?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="kasur_harga" class="control-label">Harga <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input name="kasur_harga" type="number" required class="form-control input-sm" id="kasur_harga" value="<?php echo $kasur_harga ?>" size="80" maxlength="100" placeholder="Masukan Harga"/>
                                        </td>
                                    </tr>
                                <?php if ($kasur_gambar){?>
                                    <tr>
                                        <td>
                                            <label for="kasur_gambar" class="control-label">Gambar</label>
                                        </td>
                                        <td>
                                            <img src="<?php echo base_url()."assets/images/kasur/kecil_".$kasur_gambar;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="kasur_gambar" class="control-label">Edit Gambar</label>
                                        </td>
                                        <td>
                                            <input type="file" name="kasur_gambar" id="kasur_gambar" class="form-control btn-sm input-sm" />
                                        </td>
                                    </tr>
                               <?php } else {?>
                                    <tr>
                                        <td>
                                            <label for="kasur_gambar" class="control-label">Gambar <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="file" name="kasur_gambar" id="kasur_gambar" required class="form-control btn-sm input-sm" />
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/kasur'"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<!-- ================================================== END EDIT ================================================== -->

<!-- ================================================== DETAIL ================================================== -->
<?php } elseif ($action == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/admin/css/formstyle.css"/>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Detail. Kasur</h4>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
            <tr class="awal">
                <td><strong>Kode</strong></td>
                <td>: <strong><?php echo $kasur->kasur_id;?></strong></td>
            </tr>
            <tr>
                <td width="110">Merk</td>
                <td>: <?php echo $kasur->kasur_merk;?></td>
            </tr>
            <tr class="awal">
                <td>Jenis</td>
                <td>: <?php echo $kasur->jenis_nama;?></td>
            </tr>
            <tr>
                <td>Ukuran</td>
                <td>: <?php echo $kasur->ukuran_dimensi;?></td>
            </tr>
            <tr class="awal">
                <td>Gambar</td>
                <td>: <img src="<?php echo base_url()."assets/images/kasur/kecil_".$kasur->kasur_gambar;?>"/></td>
            </tr>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
</div>
<?php } ?>               
<!-- ================================================== END DETAIL ================================================== -->
<!-- Include More Js For This Content -->                
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.slider/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>
