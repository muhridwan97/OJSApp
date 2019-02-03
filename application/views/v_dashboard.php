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
  <title>Admin Kartu IKA UB</title>
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
      <span class="logo-mini"><b>O</b>JS</span>
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
		<li class="active"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
    <li  class="treeview">
          <a href="<?php echo base_url(); ?>c_submission/">
            <i class="fa fa-envelope"></i>  <span>SUBMISSION</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li  ><a href="<?php echo base_url(); ?>c_submission/lihatAntrian">Antrian Submission</a></li>
            <li><a href="<?php echo base_url(); ?>c_submission/">Submission</a></li>
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
        DASHBOARD
      </h1>
    </section>
    <section class="content">
	
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countRevisi ;?></h3>
              <p>TOTAL REVISI</p>
            </div>
            <div class="icon">
              <i class="fa fa-table"></i>
            </div>
            <a href="<?php echo base_url(); ?>c_submission/lihatAntrian" class="small-box-footer">DETAIL <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countAntrian ;?></h3>
              <p>TOTAL ANTRIAN</p>
            </div>
            <div class="icon">
              <i class="fa fa-table"></i>
            </div>
            <a href="<?php echo base_url(); ?>c_submission/lihatAntrian" class="small-box-footer">DETAIL <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countSubmission ;?></h3>
              <p>TOTAL SUBMISSION</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="<?php echo base_url(); ?>c_submission" class="small-box-footer">DETAIL <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		<div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countPublikasi ;?></h3>
              <p>TOTAL PUBLIKASI</p>
            </div>
            <div class="icon">
              <i class="fa fa-gear"></i>
            </div>
            <a href="<?php echo base_url(); ?>c_submission/lihatPublication" class="small-box-footer">DETAIL <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
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

<script>
  $(function () {
	  $.ajaxSetup({
	type:"post",
	cache:false,
	dataType: "json"
	})
	
	


  })
</script>
</body>
</html>
