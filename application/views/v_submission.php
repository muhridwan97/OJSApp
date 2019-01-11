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
              <h3 class="box-title">Data Submission</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                 $i=0;
                foreach($user as $u){
                  $i++;
                ?>
                <tr data-id="" >
				<td ><?php echo $i; ?></td>
                  <td><?php echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></td>
                  <td>
                  <?php if("$u[stage_id]"==3){
                  ?>
                  <span class="label label-info">Verified</span>
                  <?php }else{
                  ?>
                  <span class="label label-danger">Pending</span>
                  <?php }
                  ?>
                  </td>
                  <td><div class="btn-group">
                  
                  <a href="<?php echo base_url(); ?>c_submission/lihatBerkas/<?php echo "$u[user_id]" ?>" type="button" class="btn btn-info btn-flat"><i class="fa fa-info"></i></a>
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-success btn-flat cek"
					  data-id="<?php echo "$u[user_id]" ?>" ><i class="fa fa-check"  ></i></a>
					  <a href="" type="button" class="btn btn-warning btn-flat"><i class="fa fa-send"></i></a>
                    </div></td>
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
        <h4 class="modal-title" id="myModalLabel">Publication</h4>
      </div>
      <div class="modal-body">
      <div class="box-body">
		<div class="form-group">
			<label>Issue</label>
			<select name="" id="issue"class="form-control select" style="width: 100%;">
      <option>------Future Issue------</option>
      <?php
          foreach($issue as $i){
                ?>
                
                <?php
              if( "$i[published]"==0 && "$i[current]"==0 ){
              ?>
        <option value="<?php echo "$i[issue_id]"; ?>"><?php echo "Vol "."$i[volume]"." No "."$i[number]"." ($i[year]) : "."$i[setting_value]"; ?></option>
             <?php
              }
              ?>
                <?php
              }
              ?>
      <option>------Current Issue------</option>
      <?php
          foreach($issue as $i){
                ?>
                
                <?php
              if( "$i[published]"==1 && "$i[current]"==1 ){
              ?>
        <option value="<?php echo "$i[issue_id]"; ?>"><?php echo "Vol "."$i[volume]"." No "."$i[number]"." ($i[year]) : "."$i[setting_value]"; ?></option>
             <?php
              }
              ?>
                <?php
              }
              ?>
      <option>------Back Issue------</option>
      <?php
          foreach($issue as $i){
                ?>
                
                <?php
              if( "$i[published]"==1 && "$i[current]"==0 ){
              ?>
        <option value="<?php echo "$i[issue_id]"; ?>"><?php echo "Vol "."$i[volume]"." No "."$i[number]"." ($i[year]) : "."$i[setting_value]"; ?></option>
             <?php
              }
              ?>
                <?php
              }
              ?>
      </select>
      
		</div>
                             
    <div class="form-group">
    <label>Page</label>
      <input type="text" class="form-control" id="page" value="<?php  echo 10; ?>" name="page" placeholder="Masukkan page">
      <input type="hidden" id="id_orang">
		</div>
    <div class="form-group">
    <label>Tahun</label>
      <input type="text" class="form-control" id="tahun" value="<?php    ?>" name="tahun" placeholder="2018">
		</div>
    <div class="form-group">
    <form id="formArsip" method="post" enctype="multipart/form-data">
    <label for="exampleInputFile">File arsip</label>
      <input type="file" id="fileArsip" name="fileArsip">
      </form>
      <button style="margin-top:10px;" type="submit" id="submitArsip" class="btn btn-primary" >Upload File</button>
    </div>
    <div class="form-group">
    <form id="formGalley" method="post" enctype="multipart/form-data">
    <label for="exampleInputFile">File galley</label>
      <input type="file" id="galley" name="galley">
      <button style="margin-top:10px;" id="submitGalley" class="btn btn-primary" >Upload File</button>
      </form>
    </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary publication" >Publication</button>
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
<!-- page script -->

<script>
$('.cek').on('click', function () {
  var id=$(this).data('id');
  //alert(id); 
  $('#id_orang').val(id);
});


$('#myModal').on('shown.bs.modal', function () {
  
});
  $(function () {
	  $.ajaxSetup({
	type:"post",
	cache:false,
	dataType: "json"
	})
	
	$(document).on("click",".info-pembayaran",function(){
	var id=$(this).attr("data-id");
	var harga=$(this).attr("data-harga");
	swal({
		title: "Total Harga : Rp "+ harga +" ,-",
		text:"Pembayaran harus sesuai dengan harga",
		type: "info",
		confirmButtonText: "Oke",
		closeOnConfirm: true,
	},
		);
});

$(document).on("click",".publication",function(){
	var id=$('#id_orang').val();
  var issue_id=$('#issue').val();
	var page=$('#page').prop('value');
  //var subtitle=$('#subtitle').prop('value');
  //var abstract=$('textarea#editor1').val();
  alert(issue_id);
	$.ajax({
			url:"<?php echo base_url('c_submission/setPublication'); ?>",
			data:{id:id,judul:judul,subtitle:subtitle,abstract:abstract},
			success: function(){
        alert("data berhasil di update");
			}
		 });
});

$(document).on("click","#submitArsip",function(){
  var fileArsip = $('#fileArsip').prop('files')[0];
  //var fileArsip = new FormData($("#formArsip"));
  //var fileArsip = $('#fileArsip')[0].files[0];
  //alert(qq);
  //var file_data = $('#policy_image').prop('files')[0];
  var form_data = new FormData();
  form_data.append('fileArsip', fileArsip);
  console.log(fileArsip);
	$.ajax({
			url:"<?php echo base_url('c_submission/submitArsip'); ?>",
      data:form_data,
      type: "POST",
      contentType: false,
      processData: false,
      dataType : "html",
			success: function(){
        alert("file berhasil diupload");
      },
      error: function() {
     alert("gagal");
      }
		 });
});

$(document).on("click",".ijazah-valid",function(){
	var id=$(this).attr("data-id");
	var nama=$(this).attr("data-nama");
	swal({
		title: "Ijazah atas nama  "+ nama +" Valid",
		text:"Yakin Ijazah ini valid?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Yakin",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo base_url('Adminika/ijazahValid'); ?>",
			data:{id:id},
			success: function(){
				$("tr[data-id='"+id+"']").fadeOut("fast",function(){
					$(this).remove();
				});
			}
		 });
	});
});

$(document).on("click",".hapus-member",function(){
	var id=$(this).attr("data-id");
	var nama=$(this).attr("data-nama");
	swal({
		title: "Hapus "+ nama +" sebagai Member",
		text:"Yakin akan menghapus member ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Hapus",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo base_url('Adminika/hapus'); ?>",
			data:{id:id},
			success: function(){
				$("tr[data-id='"+id+"']").fadeOut("fast",function(){
					$(this).remove();
				});
			}
		 });
	});
});
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
