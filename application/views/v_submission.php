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
  <!-- pop up -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">
  <script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Include Editor style. -->
  <link href="<?php echo base_url(); ?>/assets/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />
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
              <h3 class="box-title">Data Submission</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Status Pemeriksaan</th>
                  <th>Action</th>
                </tr>
                
                </thead>
                <tbody>
                <?php
                 $i=0;
                foreach($user as $u){
                  $i++;
                ?>
                <tr data-id="<?php echo "$u[user_id]" ?>" >
				<td ><?php echo $i; ?></td>
                  <td><?php echo "$u[first_name] $u[middle_name] $u[last_name]"; ?></td>
                  <td>
                  <?php if("$u[stage_id]"==3){
                  ?>
                  <span class="label label-info">Verified</span>
                  <?php  }else{
                  ?>
                  <span class="label label-danger">Pending</span>
                  <?php if("$u[statusSkripsi]"=="revisi"){
                  ?><span class="label label-warning">Revisi</span>
                  <?php }}
                  ?>
                  </td>
                  <td><div class="btn-group">
                  
                  <a href="<?php echo base_url(); ?>c_submission/lihatBerkas/<?php echo "$u[user_id]" ?>" type="button" class="btn btn-info btn-flat"><i class="fa fa-info"></i></a>
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-success btn-flat cek"
					  data-id="<?php echo "$u[user_id]" ?>" data-submission="<?php echo "$u[submission_id]" ?>" ><i class="fa fa-check"  ></i></a>
					  <a data-toggle="modal" data-target="#myModal2" data-id="<?php echo "$u[user_id]" ?>"  data-catatan="<?php echo "$u[catatan]" ?>" class="btn btn-warning btn-flat cekSubmission"><i class="fa fa-send"></i></a>
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
			<label>Edisi</label>
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
    <label>Halaman</label>
      <input type="text" class="form-control" id="page" value="<?php  echo 0; ?>" name="page" placeholder="Masukkan page">
      <input type="hidden" id="id_orang">
      <input type="hidden" id="submission">
      <input type="hidden" id="editor_id" value="<?php echo $this->session->userdata("user_id"); ?>">
		</div>
    <div class="form-group">
    <label>Tahun</label>
    <?php $tahun=getdate();

    ?>
      <input type="text" class="form-control" id="tahun" value="<?php  echo $tahun['year'];  ?>" name="tahun" placeholder="2018">
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
      <input type="file" id="fileGalley" name="fileGalley">
      </form>
      <button style="margin-top:10px;" type="submit" id="submitGalley" class="btn btn-primary" >Upload File</button>
    </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary publication" data-dismiss="modal">Publikasi</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 send -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email</h4>
      </div>
      <div class="modal-body">
      <div class="box-body">
      <div class="form-group">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Mengirim Email ke mahasiswa
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Mengirim Email ke mahasiswa dan dosen pembimbing
                    </label>
                  </div>
                </div>
    <div class="form-group">
    <label>Isi pesan email</label>
    <!-- <input type="hidden" id="catatan"> -->
    <input type="hidden" id="submission_id">
    <textarea id="pesan" class="form-control" name="pesan" rows="10" >
    Isi pesan
    <p></p>
    <br><br>
    Kind Regards,
    <br>
    Muhammad Ridwan
    </textarea>
		</div>
    
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary sendEmail" data-dismiss="modal" >Kirim</button>
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
<!-- Include Editor JS files. -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/froala/js/froala_editor.pkgd.min.js"></script>
<script> $(function() { $('textarea').froalaEditor() }); </script>
<script>

$('.cek').on('click', function () {
  var id=$(this).data('id');
  var submission=$(this).data('submission');
  //alert(submission); 
  $('#id_orang').val(id);
  $('#submission').val(submission);
});

$('.cekSubmission').on('click', function () {
  var id=$(this).data('id');
  var catatan=$(this).data('catatan');
  //alert(catatan); 
  $('#submission_id').val(id);//aslinya ini masih userid
  $("textarea#pesan").froalaEditor('html.set', 'isi pesan<br>'+catatan+'<br>Kind Regards,<br>Muhammad Ridwan');
});

$('#myModal').on('shown.bs.modal', function () {
  
});
  $(function () {
	  $.ajaxSetup({
	type:"post",
	cache:false,
	dataType: "json"
	})
	


$(document).on("click",".publication",function(){
	var id=$('#id_orang').val();
  var issue_id=$('#issue').val();
	var page=$('#page').prop('value');
  var tahun=$('#tahun').prop('value');
  //var subtitle=$('#subtitle').prop('value');
  //var abstract=$('textarea#editor1').val();
  //alert(issue_id);
	$.ajax({
			url:"<?php echo base_url('c_submission/setPublication'); ?>",
			data:{id:id,issue_id:issue_id,page:page,tahun:tahun},
			success: function(){
        alert("submission berhasil di publikasi");
        $("tr[data-id='"+id+"']").fadeOut("fast",function(){
					$(this).remove();
				});
			},
        error: function() {
     alert("submission gagal di publikasi");
      }
		 });
});

$(document).on("click",".sendEmail",function(){
	 var id=$('#submission_id').val();
	var pesan=$('textarea#pesan').val();
  var option=0;
  if($('#optionsRadios1').is(":checked")){
    option=1;
  }
  console.log(id);
	$.ajax({
			url:"<?php echo base_url('c_submission/decline'); ?>",
			data:{id:id},
			success: function(){
          $.ajax({
            url:"<?php echo base_url('c_submission/send_email'); ?>",
            data:{id:id,pesan:pesan,option:option},
            success: function(){
              alert("Sukses! email berhasil dikirim.");
              $("tr[data-id='"+id+"']").fadeOut("fast",function(){
					$(this).remove();
				});
            },
              error: function() {
          alert("gagal kirim email");
            }
          });
			},
        error: function() {
     alert("gagal decline");
      }
		 });
});

$(document).on("click","#submitArsip",function(){
  var fileArsip = $('#fileArsip').prop('files')[0];
  var submission_id=$('#submission').val();
  var editor_id=$('#editor_id').val();
  var form_data = new FormData();
  form_data.append('fileArsip', fileArsip);
  form_data.append('submission_id', submission_id);
  form_data.append('editor_id', editor_id);
  // console.log(submission_id);
	$.ajax({
			url:"<?php echo base_url('c_submission/submitArsip'); ?>",
      data:form_data,
      type: "POST",
      contentType: false,
      processData: false,
      dataType : "html",
			success: function(response){
        console.log(response);
        alert("file berhasil diupload");
      },
      error: function() {
     alert("gagal");
      }
		 });
});

$(document).on("click","#submitGalley",function(){
  var fileGalley = $('#fileGalley').prop('files')[0];
  var submission_id=$('#submission').val();
  var editor_id=$('#editor_id').val();
  var form_data = new FormData();
  form_data.append('fileGalley', fileGalley);
  form_data.append('submission_id', submission_id);
  form_data.append('editor_id', editor_id);
  // console.log(fileGalley);
	$.ajax({
			url:"<?php echo base_url('c_submission/submitGalley'); ?>",
      data:form_data,
      type: "POST",
      contentType: false,
      processData: false,
      dataType : "html",
			success: function(response){
        console.log(response);
        alert("file berhasil diupload");
      },
      error: function() {
     alert("gagal");
      }
		 });
});

$("#issue").change(function(){
	var value=$(this).val();
  
	$.ajax({
    url:"<?php echo base_url('c_submission/getPage'); ?>",
	data:{issueId:value},
  dataType : "html",
	success: function(response){
    console.log(response);
	$("#page").val(response);
	}
	})

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
