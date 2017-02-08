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
       
                    <h2 class="title text-center">Kontak Kami</h2>
                    <table class="table table-responsive">
                    <tbody>
                    <tr><td>Alamat : </td><td>Jl Sekeloa 21 A Bandung</td></tr><tr>
                    <td>Kodepos : </td><td>40226</td></tr>
                    <tr>
                    <td>Telepon : </td><td>22-5400470, 5402891, 5408800, 5411675</td></tr>
                    </tbody>
                    </table>

                       <div class="map-wrapper">
                                    <div id="map" style="width:auto; height: 300px;"></div> 
                                </div>
		</div>
	</div>
</section>
  <div class="end"></div>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPZGhhJH4pyTzmVegsITlLs1ewycj7f9k"></script>
<script type="text/javascript">
              
//              menentukan koordinat titik tengah peta
              var myLatlng = new google.maps.LatLng(-6.8889591,107.6159846);

//              pengaturan zoom dan titik tengah peta
              var myOptions = {
                  zoom: 15,
                  center: myLatlng
              };
              
//              menampilkan output pada element
              var map = new google.maps.Map(document.getElementById("map"), myOptions);
              
//              menambahkan marker
              var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                   title:"Monas"
              });
        </script> 
  