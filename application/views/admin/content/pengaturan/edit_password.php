<!-- Breadcrumb -->
<div class="page-head">
    <h3>Edit <small>Password</small></h3>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>admin"><i class='fa fa-home'></i> Dashboard</a></li>
        <li class="active">Edit Password</li>
	</ol>	
</div>
<!-- End Breadcrumb -->
<!-- Content -->
<div class="cl-mcont">
    <div class="row">
        <div class="col-md-12">
            <div class="block-flat">
                <div class="content">
                   
<script type="text/javascript">
function checkPass(){
	//Store the password field objects into variables ...
	var pass1 = document.getElementById('admin_pass');
	var pass2 = document.getElementById('admin_pass_ulang');
	//Store the Confimation Message Object ...
	var message = document.getElementById('confirmMessage');
	//Set the colors we will be using ...
	var goodColor = "#66cc66";
	var badColor = "#ff6666";
	//Compare the values in the password field 
	//and the confirmation field
	if(pass1.value == pass2.value){
		//The passwords match. 
		//Set the color to the good color and inform
		//the user that they have entered the correct password 
		//pass2.style.backgroundColor = goodColor;
		message.style.color = goodColor;
		message.innerHTML = "Password Sesuai!"
	}else{
		//The passwords do not match.
		//Set the color to the bad color and
		//notify the user.
		//pass2.style.backgroundColor = badColor;
		message.style.color = badColor;
		message.innerHTML = "Password Tidak Sesuai!"
	}
}  
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/admin/js/password-strength.js"></script>
<style type="text/css">
#formMenu .short{color:#FF0000;}
#formMenu .short_param{width:25px;background:#FF0000;}
#formMenu .weak{color:#E66C2C;}
#formMenu .weak_param{width:50px;background:#E66C2C;}
#formMenu .good{color:#2D98F3; }
#formMenu .good_param{width:75px;background:#2D98F3;}
#formMenu .strong{color:#006400;}
#formMenu .strong_param{width:100px;background:#006400;}
</style>
             
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
                    <?php } ?>       <!-- ========== End Flashdata ========== -->
                    <form role="form" id="formMenu" class="form-horizontal" action="<?php echo site_url();?>admin/edit_password" method="post" enctype="multipart/form-data" parsley-validate novalidate>
                        <div class="table-responsive">
                            <table class="table no-border hover">
                                <input type="hidden" name="admin_user" value="<?php echo $admin_user;?>" />
                                <tbody class="no-border-y"> 
                                    <tr>
    <td width="180"><label for="admin_pass_recent" >Password Sekarang <span class="required">*</span></label></td>
    <td><input name="admin_pass_recent" required class="form-control" type="password" id="admin_pass_recent" value="" size="30" maxlength="50"/></td>
  </tr>
  <tr>
    <td><label for="admin_pass" >Password Baru <span class="required">*</span></label></td>
    <td><input name="admin_pass" required class="form-control" type="password" id="admin_pass" value="" size="30" maxlength="50"/><div style="height: 20px; margin-left: 5px; margin-bottom: -5px; display:inline-block; width: 300px; position:relative;">
            <span id="strength"  style="font-size:10px; font-weight: bold; height:10px; display:block; position:absolute; top:0px;  margin-bottom: 2px;"></span>
            <span id="parameter" style="font-size:10px; font-weight: bold; height:10px; display:block; position:absolute; bottom:0px; margin-top: 2px;"></span>
        </div>
  </td>
  </tr>
  <tr>
    <td width="130"><label for="admin_pass_ulang" >Ulangi Password <span class="required">*</span></label></td>
    <td><input name="admin_pass_ulang"  required class="form-control" type="password" id="admin_pass_ulang" value="" size="30" maxlength="50" onkeyup="checkPass(); return false;"/><span id="confirmMessage" class="confirmMessage" style="font-size:12px; font-weight: bold; padding-left: 10px;"></span></td>
  </tr>
</table>
<div style="padding:20px 0 0 0px; text-align:center"><input class="btn btn-primary" type="submit" name="simpan" value="Simpan Data" />&nbsp;<input class="btn btn-default" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url();?>pengaturan/pengguna'"/></div>
</form>
</div>
</div>
<!-- Include More Js For This Content --> 
<!-- For Validation -->
<script type="text/javascript" src="<?php echo base_url();?>templates/admin/js/jquery.parsley/parsley.js"></script>	