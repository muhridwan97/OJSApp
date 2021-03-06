<?php
  if($this->session->userdata('username')==null){
    redirect(base_url()."c_login/");
  }
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
          <a href="<?php echo base_url(); ?>c_login/logout" > <i class="fa fa-sign-out"></i></a>
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
		<li class="active"><a href="<?php echo base_url(); ?>c_submission/"><i class="fa fa-envelope"></i> <span>SUBMISSION</span>
			<span class="pull-right-container">
              
            </span></a></li>
            
     <li ><a href="<?php echo base_url(); ?>c_settings/"><i class="fa fa-gear"></i> <span>SETTINGS</span></a></li>
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
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">CK Editor
						<small>Advanced and full of features</small>
					</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
					</div>
					<!-- /. tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body pad">
						<textarea id="editor1" class="form-control" name="editor1" rows="10" ><?php echo $abstract;?></textarea>
				</div>
			</div>
		</div>
    <div class="form-group">
    <table id="example" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>E-mail</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                 $i=0;
                 $submission_id=0;
                foreach($user as $u){
                  $i++;
                  $submission_id="$u[submission_id]";
                ?>
                <tr data-id="<?php echo "$u[submission_id]"; ?>" >
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary abstract" data-dismiss="modal" data-id="<?php echo "$submission_id"; ?>">Save changes</button>
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
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" >Save changes</button>
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
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
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
			}
		 });
	});
});

$(document).on("click",".abstract",function(){
	var id=$(this).attr("data-id");
	var judul=$('#judul').prop('value');
  var subtitle=$('#subtitle').prop('value');
  var abstract=$('textarea#editor1').val();
  alert(abstract);
	$.ajax({
			url:"<?php echo base_url('c_submission/metadata'); ?>",
			data:{id:id,judul:judul,subtitle:subtitle,abstract:abstract},
			success: function(){
        alert("data berhasil di update");
			}
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
