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
                                <a class="btn btn-primary" href="<?php echo site_url();?>admin/pegawai/tambah"><i class="fa fa-plus-circle"></i> Tambah Pegawai</a>
                            </div>  
                            <div class='pull-right'>
                                <a class="btn btn-primary" href="<?php echo site_url();?>admin/pegawai"><i class="fa fa-times-circle"></i> Bersihkan Pencarian</a>
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
                                    <th >NAMA PEGAWAI</th>
                                    <th width="200">USERNAME</th>
                                    <th width="200">LEVEL</th>
                                    <th width="120">AKSI</th>
	                           </tr>
                            </thead>
                            <tbody>
                                <?php 
	                            $i	= $page+1;
	                            $like_pegawai[$cari]	= $q;
                            if ($jml_data > 0){
	                            foreach ($this->ADM->grid_all_pegawai('', 'pegawai_id', 'DESC', $batas, $page, '', $like_pegawai) as $row){
	                            ?>
                                <tr>
    	                            <td align="center"><?php echo $i;?></td>
                                    <td><?php echo $row->pegawai_nama;?></td>
                                    <td><?php echo $row->pegawai_username;?></td>
                                    <td><?php echo $row->pegawai_level;?></td>
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
                                                    <a href="<?php echo site_url();?>admin/pegawai/edit/<?php echo $row->pegawai_id; ?>" title="Edit"><i class='fa fa-pencil'></i> Edit</a>
                                                </li>
									            <!--li>
                                                    <a data-toggle="modal" data-target="#mod-info" type="button"   href="<?php echo site_url();?>admin/pegawai_detail/<?php echo $row->pegawai_id;?>" rel="detail" title="Detail <?php echo $row->pegawai_nama; ?>"><i class='fa fa-eye'></i> Detail</a>
                                                </li-->
									            <li>
                                                    <a href="javascript:;" data-id="<?php echo $row->pegawai_id;?>" data-toggle="modal" data-target="#modal-konfirmasi" title="Hapus <?php echo $row->pegawai_nama; ?>"><i class='fa fa-trash-o'></i> Hapus</a>
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
                                <?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'admin/pegawai/view', $id=""); }?>
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-pegawai">Ya</a>
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
        <li><a href="<?php echo base_url();?>admin/pegawai"><?php echo $breadcrumb; ?></a></li>
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
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>admin/pegawai/tambah" method="post" enctype="multipart/form-data" parsley-validate novalidate>
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y">
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_nama" class="control-label">Nama <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_nama" id="pegawai_nama" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan nama"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_jabatan" class="control-label">Jabatan <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_jabatan" id="pegawai_jabatan" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan Jabatan"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_username" class="control-label">Username <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_username" id="pegawai_username" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan Username"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_password" class="control-label">Password <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="pegawai_password" id="pegawai_password" required class="form-control input-sm" value="" size="80" maxlength="100" placeholder="Masukan Password"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            <label for="pegawai_level" class="control-label">Level Akses </label>
                                        </td>
                                        <td>
                                            <div id="icheck">
                                                <label class="radio-inline"> 
                                                    <input type="radio" name="pegawai_level" id="aktif" class="icheck" value="pemilik"> Pemilik
                                                </label> 
                                                <label class="radio-inline"> 
                                                    <input type="radio" checked="" name="pegawai_level" id="tidak_aktif" class="icheck" value="pegawai"> Pegawai
                                                </label> 
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/pegawai'"/>
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
        <li><a href="<?php echo base_url();?>admin/pegawai"><?php echo $breadcrumb; ?></a></li>
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
                    <form role="form" class="form-horizontal" action="<?php echo site_url();?>admin/pegawai/edit" method="post" enctype="multipart/form-data" parsley-validate novalidate>
                        <input type="hidden" name="pegawai_id" value="<?php echo $pegawai_id;?>" />
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <tbody class="no-border-y"> 
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_nama" class="control-label">Nama <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_nama" id="pegawai_nama" required class="form-control input-sm" value="<?php echo $pegawai_nama; ?>" size="80" maxlength="100" placeholder="Masukan nama"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_jabatan" class="control-label">Jabatan <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_jabatan" id="pegawai_jabatan" required class="form-control input-sm" value="<?php echo $pegawai_jabatan; ?>" size="80" maxlength="100" placeholder="Masukan Jabatan"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_username" class="control-label">Username <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="pegawai_username" id="pegawai_username" required class="form-control input-sm" value="<?php echo $pegawai_username; ?>" size="80" maxlength="100" placeholder="Masukan Username"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="130">
                                            <label for="pegawai_password" class="control-label">Password <span class="required">*</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="pegawai_password" class="form-control input-sm" value="" size="80" maxlength="100" />*Kosongkan Password bila tidak diubah
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            <label for="pegawai_level" class="control-label">Level Akses </label>
                                        </td>
                                        <td>
                                            <div id="icheck">
                                                <label class="radio-inline"> 
                                                    <input type="radio" name="pegawai_level" id="pemilik" class="icheck" value="pemilik"  <?php echo $pemilik = ($pegawai_level=='pemilik')?'checked':'';?>/> Pemilik
                                                </label> 
                                                <label class="radio-inline"> 
                                                    <input type="radio"  name="pegawai_level" id="pegawai" class="icheck" value="pegawai" <?php echo $pegawai = ($pegawai_level=='pegawai')?'checked':'';?>/> Pegawai
                                                </label> 
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class='center'>
                            <input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data">
                            <input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>admin/pegawai'"/>
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
    <h4 class="modal-title">Detail. pegawai</h4>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" id="form_detail">
            <tr class="awal">
                <td><strong>Kode</strong></td>
                <td>: <strong><?php echo $pegawai->pegawai_id;?></strong></td>
            </tr>
            <tr>
                <td width="110">nama</td>
                <td>: <?php echo $pegawai->pegawai_nama;?></td>
            </tr>
            <tr class="awal">
                <td>Jenis</td>
                <td>: <?php echo $pegawai->jenis_nama;?></td>
            </tr>
            <tr>
                <td>Ukuran</td>
                <td>: <?php echo $pegawai->ukuran_dimensi;?></td>
            </tr>
            <tr class="awal">
                <td>Gambar</td>
                <td>: <img src="<?php echo base_url()."assets/images/pegawai/kecil_".$pegawai->pegawai_gambar;?>"/></td>
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
