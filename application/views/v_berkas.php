<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin OJSApp</title>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>/assets/images/iconUb.jpeg">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/iCheck/all.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- pop up -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">
  <script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="<?php echo base_url(); ?>adminika/" class="logo">
      <span class="logo-mini"><b>I</b>KA</span>
      <span class="logo-lg"><b>Admin</b> OJSApp</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="<?php echo base_url(); ?>login/logoutAdmin" >KELUAR <i class="fa fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata("username"); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		<li ><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
		<li class="active" class="treeview">
          <a href="<?php echo base_url(); ?>c_submission/">
            <i class="fa fa-envelope"></i>  <span>SUBMISSION</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  ><a href="<?php echo base_url(); ?>c_submission/lihatAntrian">Antrian Submission</a></li>
            <li class="active" ><a href="<?php echo base_url(); ?>c_submission/">Submission</a></li>
            <li ><a href="<?php echo base_url(); ?>c_submission/lihatPublication">Publication</a></li>
          </ul>
        </li>
			<span class="pull-right-container">
              
            </span></a></li>
       </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        SUBMISSION
      </h1>
    </section>
    <section class="content">
	
    <div class="col-sm-6 col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php foreach($userFiles as $u){ }echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></h3>
              <button type="button" style="margin-right:10px;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                Metadata
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama Berkas</th>
                  <th>Jenis Berkas</th>
                  <th>Action</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                 $i=0;
                 $judul="";
                 $subtitle="";
                 $abstract="";
                foreach($userFiles as $u){
                  $i++;
                  $judul="$u[judul]";
                  $subtitle="$u[subtitle]";
                  $abstract="$u[abstract]";
                  $abstract=str_replace('<p>', '', $abstract);
                  $abstract=str_replace('</p>', '', $abstract);
                ?>
                <tr data-id="<?php echo "$u[uploader_user_id] "; ?>" >
				<td ><?php echo $i; ?></td>
                  <td><a href="<?php echo base_url(); ?>c_submission/alamatBerkas/<?php echo "$u[file_id]" ?>" target="_blank" ><?php echo "$u[nama_file] "; ?></a></td>
                  <td><?php echo "$u[jenis_berkas] "; ?>
                  </td>
                  <td><div class="btn-group">
                  <label>
                  <input type="checkbox" data-id="<?php echo "$u[uploader_user_id] "; ?>" class="getSubmit" value="<?php echo "$u[jenis_berkas] "; ?>"
                   <?php foreach($userApp as $us){ 
                     if(str_replace(' ', '', "$u[jenis_berkas]")=="FormSC2-17"){
                       if("$us[FormSC2_17]"==1)
                       echo "checked";
                       }
                     if(str_replace(' ', '', "$u[jenis_berkas]")=="FormSC2-12"){
                       if("$us[FormSC2_12]"==1)
                       echo "checked";
                       }  
                    if(str_replace(' ', '', "$u[jenis_berkas]")=="ArticleText"){
                       if("$us[ArticleText]"==1)
                       echo "checked";
                       }
                    if(str_replace(' ', '', "$u[jenis_berkas]")=="PerjanjianHakCipta"){
                       if("$us[PerjanjianHakCipta]"==1)
                       echo "checked";
                       }
                    if(str_replace(' ', '', "$u[jenis_berkas]")=="EtikaPublikasi"){
                       if("$us[EtikaPublikasi]"==1)
                       echo "checked";
                       }
                    if(str_replace(' ', '', "$u[jenis_berkas]")=="CekPlagiasidenganTurnitin"){
                       if("$us[CekPlagiasidenganTurnitin]"==1)
                       echo "checked";
                       }
                    }?>>
                </label>
                      
                    </div></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
              <div class="box-footer">
              <input type="hidden" id="uploader_user_id" value="<?php echo "$u[uploader_user_id]"; ?>">
                <button  type="submit" data-id="<?php echo "$u[uploader_user_id] "; ?>" 
                data-nama="<?php echo "$u[first_name] $u[middle_name] $u[last_name]"; ?>"  style="margin-top:20px;" class="btn btn-primary pull-right verifikasi">Verifikasi</button>
                
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

 <!-- /.data skripsi filkomapp -->
        <div class="col-sm-6 col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php foreach($userFiles as $u){ }echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama Berkas</th>
                  <th>Jenis Berkas</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                foreach($berkasApp as $u){
                ?>
                <tr data-id=" "" >
				<td >1</td>
                  <td><a href="<?php echo base_url(); ?>c_submission/alamatBerkasApp/<?php echo "$u[hardcover]" ?>" target="_blank" ><?php echo "$u[hardcover] "; ?></a></td>
                  <td>hardcover
                  </td>
                  
                </tr>
                <tr data-id=" "" >
				<td >2</td>
                  <td><a href="<?php echo base_url(); ?>c_submission/alamatBerkasApp/<?php echo "$u[sc_12]" ?>" target="_blank" ><?php echo "$u[sc_12] "; ?></a></td>
                  <td>SC-12
                  </td>
                  
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
  
  <!-- /.modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Metadata</h4>
      </div>
      <div class="modal-body">
<form action="<?php echo base_url(); ?>#" method="post" enctype="multipart/form-data">
	<div class="box-body">
		<div class="form-group">
			<label>Judul</label>
			<input type="text" class="form-control" id="judul" value="<?php  echo $judul; ?>" name="judul" placeholder="Masukkan Judul">
		</div>
		<div class="form-group">
			<label>Subtitle</label>
			<input type="text" class="form-control" id="subtitle" value="<?php echo $subtitle;  ?>" name="subtitle" placeholder="Masukkan Subtitle">
		</div>
		<div class="form-group">
    <label>Abstract</label>
    <textarea id="editor2" class="form-control" name="editor2" rows="10" ><?php echo $abstract;?></textarea>
		</div>
    <div class="form-group">
			<label>Keyword</label>
      <?php 
      $hasilKeyword="";
      foreach($keyword as $k){
        $hasilKeyword="$k[setting_value]";}   ?>
			<input type="text" class="form-control" id="keyword" value="<?php echo $hasilKeyword;  ?>" name="keyword" placeholder="Masukkan keyword">
		</div>
    <div class="form-group">
    <label>Penulis</label>
    <table id="example" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>E-mail</th>
                </tr>
                
                </thead>
                <tbody id="penulis">
                <?php
                 $i=0;
                 $submission_id=0;
                foreach($user as $u){
                  $i++;
                  $submission_id="$u[submission_id]";
                ?>
                <tr data-id="<?php echo "$u[seq]"; ?>" >
				<td ><?php echo $i; ?></td>
                  <td><?php echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></td>
                  <td><?php echo "$u[email]"; ?></td>
                  
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
		</div>
	</div>
</form>
      <button type="button"  class="btn btn-primary " data-toggle="modal" data-target="#myModal2">
                Tambah Penulis
              </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary abstract" data-dismiss="modal" data-id="<?php echo "$submission_id"; ?>">Simpan</button>
      </div>
    </div>
  </div>
</div>
	  <!-- /.modal2 -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Penulis</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="form-group col-xs-3">
			<label>First Name</label>
			<input type="text" class="form-control" id="first_name" value="" name="first_name">
		</div>
    <div class="form-group col-xs-3">
			<label>Middle Name</label>
			<input type="text" class="form-control" id="middle_name" value="" name="middle_name">
		</div>
    <div class="form-group col-xs-3">
			<label>Last Name</label>
			<input type="text" class="form-control" id="last_name" value="" name="last_name">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<label>Email</label>
			<input type="text" class="form-control" id="email" value="" name="email">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<label>Affiliation</label>
			<input type="text" class="form-control" id="affiliation" value="Universitas Brawijaya" name="affiliation">
		</div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary tambahPenulis"data-dismiss="modal" data-id="<?php echo "$submission_id"; ?>">Simpan</button>
      </div>
    </div>
  </div>
</div>
		
		
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>&copy; 2018 DEVELOPED BY <a href="<?php echo base_url(); ?>">Muhammad Ridwan</a>.</strong> ALL RIGHTS RESERVED.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>/assets/dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>/assets/plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>/assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
  $(function () {
	  $.ajaxSetup({
	type:"post",
	cache:false,
	dataType: "json"
	})

  

  $(document).ready(function(){
        $(".getSubmit").change(function() { 
          var id=$(this).attr("data-id");
          var value= $(this).val();
            if($(this).is(":checked")) { 
                $.ajax({
                    url: "<?php echo base_url('c_submission/centang'); ?>",
                    data: { id:id, value:value, strState:1 }
                });
            } else {
                $.ajax({
                  url: "<?php echo base_url('c_submission/centang'); ?>",
                    data: { id:id, value:value, strState:0 }
                });
            }
        }); 
    });


$(document).on("click",".verifikasi",function(){
	var id=$(this).attr("data-id");
  var nama=$(this).attr("data-nama");
  $.ajax({
			url:"<?php echo base_url('c_submission/cekComboBox'); ?>",
			data:{id:id},
			success: function(){
        swal({
          title: "Submission atas nama "+ nama +" benar",
          text:"Verifikasi?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Ya",
          closeOnConfirm: true,
        },
          function(){
          $.ajax({
            url:"<?php echo base_url('c_submission/verifikasi'); ?>",
            data:{id:id},
            success: function(){
              alert("verifikasi berhasil");
              location.href = "<?php echo base_url('c_submission/'); ?>"
            }
          });
        });
      },
      error: function() {
     alert("berkas belum di cek semua");
      }
		 });
	
});

$(document).on("click",".abstract",function(){
	var id=$(this).attr("data-id");
	var judul=$('#judul').prop('value');
  var subtitle=$('#subtitle').prop('value');
  var abstract=$('textarea#editor2').val();
  var keyword=$('#keyword').prop('value');
  console.log(keyword);
	$.ajax({
			url:"<?php echo base_url('c_submission/metadata'); ?>",
			data:{id:id,judul:judul,subtitle:subtitle,abstract:abstract,keyword:keyword},
			success: function(){
        alert("data berhasil di update");
			}
		 });
});
$(document).on("click",".tambahPenulis",function(){
  var id=$(this).attr("data-id");
	var first_name=$('#first_name').prop('value');
  var middle_name=$('#middle_name').prop('value');
  var last_name=$('#last_name').prop('value');
  var email=$('#email').prop('value');
  var affiliation=$('#affiliation').prop('value');
  //console.log(id);
	$.ajax({
			url:"<?php echo base_url('c_submission/tambahPenulis'); ?>",
      data:{id:id,first_name:first_name,
        middle_name:middle_name,
        last_name:last_name,
        email:email,
        affiliation:affiliation},
			success: function(){
        var userId=$('#uploader_user_id').val();
        console.log(userId);
        $.ajax({
        url:"<?php echo base_url('c_submission/reloadPenulis'); ?>",
        data:{userId:userId},
        type: "POST",
        dataType : "html",
        success: function(response){
          console.log(response);
        $("#penulis").html(response);
        },
        error: function() {
     alert("gagal reload");
      }
        })
        alert("data berhasil di update");
			}
		 });
});



//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-green'
    })
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
