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
  <!-- floating -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/float/style.css">
  <!-- Include Editor style. -->
  <link href="<?php echo base_url(); ?>/assets/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />
  <!-- ngtags -->
  <link rel="stylesheet" href="path/to/ng-tags-input.min.css">     
<link rel="stylesheet" href="path/to/ng-tags-input.bootstrap.min.css">
  
  


    <!-- These few CSS files are just to make this example page look nice. You can ignore them. -->
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/reset-fonts/reset-fonts.css">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/base/base-min.css">
    <link href="http://fonts.googleapis.com/css?family=Brawler" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/custom-select/_static/master.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/custom-select/_static/subpage.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/custom-select/_static/examples.css" rel="stylesheet" type="text/css">
    <!-- /ignore -->


    <!-- INSTRUCTIONS -->

    <!-- 2 CSS files are required: -->
    <!--   * Tag-it's base CSS (jquery.tagit.css). -->
    <!--   * Any theme CSS (either a jQuery UI theme such as "flick", or one that's bundled with Tag-it, e.g. tagit.ui-zendesk.css as in this example.) -->
    <!-- The base CSS and tagit.ui-zendesk.css theme are scoped to the Tag-it widget, so they shouldn't affect anything else in your site, unlike with jQuery UI themes. -->
    <link href="<?=base_url()?>assets/custom-select/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/custom-select/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <!-- If you want the jQuery UI "flick" theme, you can use this instead, but it's not scoped to just Tag-it like tagit.ui-zendesk is: -->
    <!--   <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css"> -->

    <!-- jQuery and jQuery UI are required dependencies. -->
    <!-- Although we use jQuery 1.4 here, it's tested with the latest too (1.8.3 as of writing this.) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- The real deal -->
    <script src="<?=base_url()?>assets/custom-select/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
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
        PUBLICATION
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
                 $judul="";
                 $subtitle="";
                 $abstract2="";
                 $uploader_user_id="";
                 $pesan="";
                foreach($userFiles as $u){
                  $judulOJS="$u[judul]";
                  $subtitle="$u[subtitle]";
                  $abstract="$u[abstract]";
                  $abstract2="$u[abstract2]";
                  $uploader_user_id="$u[uploader_user_id]";
                }
                 $i=0;
                foreach($userFilesPub as $u){
                  $i++;
                ?>
                <tr data-id="<?php echo "$u[uploader_user_id] "; ?>" >
				<td ><?php echo $i; ?></td>
                  <td><a data-id="<?php echo "$u[file_id]" ?>" class="lihatBerkas" target="_blank" ><?php echo "$u[nama_file] "; ?></a></td>
                  <td><?php echo "Galley"; ?>
                  </td>
                  
                </tr>
                <?php
                }
                foreach($userFilesArsip as $u){
                  $i++;
                ?>
                <tr data-id="<?php echo "$u[uploader_user_id] "; ?>" >
        <td ><?php echo $i; ?><input type="hidden" id="uploader_user_id" value="<?php echo "$u[uploader_user_id]"; ?>"></td>
        
                  <td><a data-id="<?php echo "$u[file_id]" ?>" class="lihatBerkasArsip" target="_blank" ><?php echo "$u[nama_file] "; ?></a></td>
                  <td><?php echo "Arsip"; ?>
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
        <div class="col-sm-6 col-xs-12">
        <iframe height="700" width="100%" id="iframeOJS"  src="" download></iframe>
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
			<h4>Judul Inggris</h4>
			<input type="text" class="form-control" id="judul" value="<?php  echo $judulOJS; ?>" name="judul" placeholder="Masukkan Judul">
		</div>
		<div class="form-group">
			<h4>Judul Indonesia</h4>
			<input type="text" class="form-control" id="subtitle" value="<?php echo $subtitle;  ?>" name="subtitle" placeholder="Masukkan Subtitle">
		</div>
		<div class="form-group">
    <h4>Abstract Inggris</h4>
    <textarea id="editor2" class="form-control" name="editor2" rows="10" ><?php echo $abstract;?></textarea>
    </div>
    <div class="form-group">
    <h4>Abstract Indonesia</h4>
    <textarea id="editor3" class="form-control" name="editor3" rows="10" ><?php echo $abstract2;?></textarea>
		</div>
    <div class="form-group">
			<h4>Keyword inggris</h4>
      <?php 
      $hasilKeyword="";
      foreach($keyword as $k){
        $hasilKeyword="$k[setting_value]";}   ?>
			<!--<input type="text" class="form-control" id="keyword" value="<?php echo $hasilKeyword;  ?>" name="keyword" placeholder="Masukkan keyword">-->
      <input name="keyword" id="keyword" value="<?php echo $hasilKeyword;  ?>" disabled="true" hidden>
            <ul id="keywordTags"></ul>
		</div>
  
        <div class="form-group">
        <h4>Keyword Indonesia</h4>
        <?php 
        $hasilKeywordInd="";
        foreach($keywordInd as $k){
          $hasilKeywordInd="$k[setting_value]";}   ?>
            <input name="keywordInd" id="keywordInd" value="<?php echo $hasilKeywordInd;  ?>" disabled="true" hidden>
            <ul id="keywordIndTags"></ul>
        </div>
        <div class="form-group">
    <h4>Penulis</h4>
    <table id="example" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>E-mail</th>
                  <th>Action</th>
                </tr>
                
                </thead>
                <tbody class="penulis">
                <?php
                 $i=0;
                 $submission_id=0;
                foreach($user as $u){
                  $i++;
                  $submission_id="$u[submission_id]";
                ?>
                <tr class ="author<?php echo "$u[author_id]";?>" data-id="<?php echo "$u[seq]"; ?>" >
				<td ><?php echo $i; ?></td>
                  <td><?php echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></td>
                  <td><?php echo "$u[email]"; ?></td>
                  <td>
                  <a data-author_id="<?php echo "$u[author_id]"; ?>" data-first_name="<?php echo "$u[first_name]"; ?>" data-middle_name="<?php echo "$u[middle_name]"; ?>" 
                  data-last_name="<?php echo "$u[last_name]"; ?>" data-email="<?php echo "$u[email]"; ?>" data-toggle="modal" data-target="#myModalEdit" type="button" 
                  class="btn btn-info btn-flat cekEdit"><i data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="fa fa-edit"></i></a>
                  <a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-flat cek"
					        data-id="" data-submission="" ><i data-toggle="tooltip" data-placement="top" data-original-title="Hapus" class="fa fa-close"  ></i></a>
                  </td>
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
			<h4>First Name</h4>
			<input type="text" class="form-control" id="first_name" value="" name="first_name">
		</div>
    <div class="form-group col-xs-3">
			<h4>Middle Name</h4>
			<input type="text" class="form-control" id="middle_name" value="" name="middle_name">
		</div>
    <div class="form-group col-xs-3">
			<h4>Last Name</h4>
			<input type="text" class="form-control" id="last_name" value="" name="last_name">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<h4>Email</h4>
			<input type="text" class="form-control" id="email" value="" name="email">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<h4>Affiliation</h4>
			<input type="text" class="form-control" id="affiliation" value="Fakultas Ilmu Komputer Universitas Brawijaya" name="affiliation">
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
<div class="modalDinamis">
<?php $i=0; foreach($user as $u){ $i++; ?>

<!-- /.modal6 -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <input type="text" id="author_id" value="" name="author_id" hidden>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Penulis <?=$i?></h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="form-group col-xs-3">
			<h4>First Name</h4>
			<input type="text" class="form-control" id="first_nameEdit" value="" name="first_nameEdit">
		</div>
    <div class="form-group col-xs-3">
			<h4>Middle Name</h4>
			<input type="text" class="form-control" id="middle_nameEdit" value="" name="middle_nameEdit">
		</div>
    <div class="form-group col-xs-3">
			<h4>Last Name</h4>
			<input type="text" class="form-control" id="last_nameEdit" value="" name="last_nameEdit">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<h4>Email</h4>
			<input type="text" class="form-control" id="emailEdit" value="" name="emailEdit">
		</div>
    </div>
    <div class="row">
      <div class="form-group col-xs-6">
			<h4>Affiliation</h4>
			<input type="text" class="form-control" id="affiliationEdit" value="Fakultas Ilmu Komputer Universitas Brawijaya" name="affiliationEdit">
		</div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary editPenulis"data-dismiss="modal">Simpan</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

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
<!-- <script src="<?php echo base_url(); ?>/assets/bower_components/jquery/dist/jquery.min.js"></script> -->
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
<!-- Include Editor JS files. -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/froala/js/froala_editor.pkgd.min.js"></script>
<script> $(function() { $('textarea').froalaEditor() }); </script>
<script>
        $(function(){
            var sampleTags = ['inisialisasi variabel contohnya'];
            $('#myTags').tagit();
            $('#singleFieldTags').tagit({
                availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#mySingleField')
            });
            $('#keywordTags').tagit({
                availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#keyword')
            });
            $('#keywordIndTags').tagit({
                availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#keywordInd')
            });
        });
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
  $(document).on("click",".lihatBerkas",function(){
	var fileId=$(this).attr("data-id");
  //alert(fileId);
	$.ajax({
			url:"<?php echo base_url('c_submission/alamatBerkasPubOJS'); ?>",
			data:{fileId:fileId},
      dataType:"html",
			success: function(response){
        console.log(response);
        $('#iframeOJS').attr('src', response)
			},
        error: function() {
     alert("gagal");
      }
		 });
});
$(document).on("click",".lihatBerkasArsip",function(){
	var fileId=$(this).attr("data-id");
  //alert(fileId);
	$.ajax({
			url:"<?php echo base_url('c_submission/alamatBerkasArsipOJS'); ?>",
			data:{fileId:fileId},
      dataType:"html",
			success: function(response){
        console.log(response);
        $('#iframeOJS').attr('src', response)
			},
        error: function() {
     alert("gagal");
      }
		 });
});
    $(document).on("click",".abstract",function(){
	var id=$(this).attr("data-id");
	var judul=$('#judul').prop('value');
  var subtitle=$('#subtitle').prop('value');
  var abstract=$('textarea#editor2').val();
  var abstract2=$('textarea#editor3').val();
  var keyword=$('#keyword').prop('value');
  var keywordInd=$('#keywordInd').prop('value');
  console.log(keyword);
	$.ajax({
			url:"<?php echo base_url('c_submission/metadata'); ?>",
			data:{id:id,judul:judul,subtitle:subtitle,abstract:abstract,abstract2:abstract2,keyword:keyword,keywordInd:keywordInd},
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
$('.cekEdit').on('click', function () {
  var first_name=$(this).data('first_name');
  var middle_name=$(this).data('middle_name');
  var last_name=$(this).data('last_name');
  var email=$(this).data('email');
  var author_id=$(this).data('author_id');
  // alert(author_id);
  console.log(first_name); 
  $('#first_nameEdit').val(first_name);
  $('#middle_nameEdit').val(middle_name);
  $('#last_nameEdit').val(last_name);
  $('#emailEdit').val(email);
  $('#author_id').val(author_id);
});
$(document).on("click",".editPenulis",function(){
  var author_id=$('#author_id').prop('value');
	var first_name=$('#first_nameEdit').prop('value');
  var middle_name=$('#middle_nameEdit').prop('value');
  var last_name=$('#last_nameEdit').prop('value');
  var email=$('#emailEdit').prop('value');
  var affiliation=$('#affiliationEdit').prop('value');
  //console.log(id);
	$.ajax({
			url:"<?php echo base_url('c_submission/editPenulis'); ?>",
      data:{author_id:author_id,first_name:first_name,
        middle_name:middle_name,
        last_name:last_name,
        email:email,
        affiliation:affiliation},
			success: function(){
        var userId=$('#uploader_user_id').val();
        console.log(userId);
        $.ajax({
        url:"<?php echo base_url('c_submission/reloadPenulisEdit'); ?>",
        data:{userId:userId,author_id:author_id},
        type: "POST",
        dataType : "html",
        success: function(response){
          console.log(response);
        $(".author"+author_id).html(response);
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
