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
  <script>
window.onload = function () {

  var submissionMasuk = [];
  var publikasi = [];
  var skripsi = [];
  var submissionMasuk2 = [];
  var publikasi2 = [];
  var skripsi2 = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Submission Traffic"
	},
	axisX:{
		valueFormatString: "DD MMM",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: "Jumlah Mahasiswa",
		crosshair: {
			enabled: true
		}
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		itemclick: toogleDataSeries
	},
	data: [{
		type: "line",
		showInLegend: true,
		name: "Jumlah Submission Masuk",
		markerType: "square",
		xValueFormatString: "DD MMM, YYYY",
		color: "#FF0800",
		dataPoints: submissionMasuk
	},
  {
		type: "line",
		showInLegend: true,
		name: "Jumlah Publikasi",
		xValueFormatString: "DD MMM, YYYY",
		color: "#008ECC",
		dataPoints: publikasi
	},
  {
		type: "line",
		showInLegend: true,
		name: "Skripsi Selesai",
		lineDashType: "dash",
    color: "#39FF14",
		dataPoints: skripsi
		
	}]
});
chart.render();

function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		submissionMasuk.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart.render();

}

$.getJSON("http://localhost/serviceOJS/api/getTanggalSubmission", addData);

function addDataPub(data) {
	for (var i = 0; i < data.length; i++) {
		publikasi.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart.render();

}

$.getJSON("http://localhost/serviceOJS/api/getTanggalPublication", addDataPub);

function addDataSkr(data) {
	for (var i = 0; i < data.length; i++) {
		skripsi.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart.render();

}

$.getJSON("<?php echo base_url('c_dashboard/getTanggalSkripsi'); ?>", addDataSkr);

var totalVisitors = 0;
var dataDonat=[];
function addDataDonat(data) {
    totalVisitors = data[0].total;
    dataDonat.push(
      { y: data[0].submission, name: "Submission Masuk", color: "#E7823A" },
			{ y: data[0].publikasi, name: "Publication", color: "#546BC1" });
	chart2.render();
}

$.getJSON("http://localhost/serviceOJS/api/getTotalSubPub", addDataDonat);

var visitorsData = {
	"Submission Masuk vs Publication": [{
		click: visitorsChartDrilldownHandler,
		cursor: "pointer",
		explodeOnClick: false,
		innerRadius: "60%",
		legendMarkerType: "square",
		name: "Submission Masuk vs Publication",
		radius: "100%",
		showInLegend: true,
		startAngle: 90,
		type: "doughnut",
		dataPoints: dataDonat
	}],
	"Submission Masuk": [{
		color: "#E7823A",
		name: "Submission Masuk",
		type: "column",
		dataPoints: submissionMasuk2,
    xValueFormatString: "MMM, YYYY"
	}],
	"Publication": [{
		color: "#546BC1",
		name: "Publication",
		type: "column",
		dataPoints: publikasi2,
    xValueFormatString: "MMM, YYYY",\
	}]
};

var newVSReturningVisitorsOptions = {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Submission Masuk vs Publication"
	},
	subtitles: [{
		text: "Klik untuk menampilkan detail",
		backgroundColor: "#2eacd1",
		fontSize: 16,
		fontColor: "white",
		padding: 5
	}],
	legend: {
		fontFamily: "calibri",
		fontSize: 14,
		itemTextFormatter: function (e) {
			return e.dataPoint.name + ": " + Math.round(e.dataPoint.y / totalVisitors * 100) + "%";  
		}
	},
	data: []
};

var visitorsDrilldownedChartOptions = {
	animationEnabled: true,
	theme: "light2",
	axisX: {
		labelFontColor: "#717171",
		lineColor: "#a2a2a2",
		tickColor: "#a2a2a2"
	},
	axisY: {
		gridThickness: 0,
		includeZero: false,
		labelFontColor: "#717171",
		lineColor: "#a2a2a2",
		tickColor: "#a2a2a2",
		lineThickness: 1
	},
	data: []
};

var chart2 = new CanvasJS.Chart("chartContainer2", newVSReturningVisitorsOptions);
chart2.options.data = visitorsData["Submission Masuk vs Publication"];
chart2.render();

function visitorsChartDrilldownHandler(e) {
	chart2 = new CanvasJS.Chart("chartContainer2", visitorsDrilldownedChartOptions);
	chart2.options.data = visitorsData[e.dataPoint.name];
	chart2.options.title = { text: e.dataPoint.name }
	chart2.render();
	$("#backButton").toggleClass("invisible");
}

$("#backButton").click(function() { 
	$(this).toggleClass("invisible");
	chart2 = new CanvasJS.Chart("chartContainer2", newVSReturningVisitorsOptions);
	chart2.options.data = visitorsData["Submission Masuk vs Publication"];
	chart2.render();
});



var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title:{
		text: "Grafik 12 Bulan Terakhir"
	},
	axisX: {
		interval: 1,
		intervalType: "month",
		valueFormatString: "MMM-YYYY"
	},	
	axisY: {
		title: "Jumlah Mahasiswa",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries3
	},
	data: [{
		type: "column",
		name: "Jumlah Submission Masuk",
		legendText: "Jumlah Submission Masuk",
    xValueFormatString: "MMM, YYYY",
		showInLegend: true, 
		dataPoints:submissionMasuk2
	},
	{
		type: "column",	
		name: "Skripsi Selesai",
		legendText: "Skripsi Selesai",
    xValueFormatString: "MMM, YYYY",
		showInLegend: true,
		dataPoints:skripsi2
	},
  {
		type: "column",
		name: "Jumlah Publikasi",
		legendText: "Jumlah Publikasi",
    xValueFormatString: "MMM, YYYY",
		showInLegend: true, 
		dataPoints:publikasi2
	}]
});
chart3.render();
function toggleDataSeries3(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart3.render();
}
function addData2(data) {
	for (var i = 0; i < data.length; i++) {
		submissionMasuk2.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart3.render();

}

$.getJSON("http://localhost/serviceOJS/api/getBulanSubmission", addData2);

function addDataPub2(data) {
	for (var i = 0; i < data.length; i++) {
		publikasi2.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart3.render();

}

$.getJSON("http://localhost/serviceOJS/api/getBulanPublication", addDataPub2);

function addDataSkr2(data) {
	for (var i = 0; i < data.length; i++) {
		skripsi2.push({
			x: new Date(data[i].date),
			y: data[i].unit
		});
	}
	chart3.render();

}

$.getJSON("<?php echo base_url('c_dashboard/getBulanSkripsi'); ?>", addDataSkr2);


}
</script>
<style>
  #backButton {
	border-radius: 4px;
	padding: 8px;
	border: none;
	font-size: 16px;
	background-color: #2eacd1;
	color: white;
	position: absolute;
	top: 10px;
	right: 10px;
	cursor: pointer;
  }
  .invisible {
    display: none;
  }
</style>
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
			
        <li ><a href="<?php echo base_url(); ?>c_settings/"><i class="fa fa-gear"></i> <span>SETTINGS</span></a></li>
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
        <div class="col-md-12">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Traffic</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
          <!-- /.box -->
          <div class="row">
          <div class="col-md-6">
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
            <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
            <button class="btn invisible" id="backButton">< Back</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Submission Traffic</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
              <div id="chartContainer" style="height: 370px; width: 100%;"></div>
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
<!-- canvasJs -->
<script src="<?php echo base_url(); ?>/assets/canvasjs/canvasjs.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/canvasjs/jquery-1.11.1.min.js"></script>
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
