<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>e-Presensi</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>datepicker/datepicker.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>datepicker/bootstrap-clockpicker.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/chosen.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/datepicker.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/bootstrap-datetimepicker.css" />
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/colorpicker.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" type="text/css" href="<?php echo ASSET_SAYA ?>tippedJs/css/tipped/tipped.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
                <script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ASSET_SAYA ?>js/jquery.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo ASSET_SAYA ?>js/ace-extra.js"></script>
                <script src="<?php echo ASSET_SAYA ?>js/autoNumeric.js"></script>

	<link rel="styleSheet" href="<?php echo ASSET_SAYA ?>dtree/dtree.css" type="text/css" />
	<script type="text/javascript" src="<?php echo ASSET_SAYA ?>dtree/dtree.js"></script>
	<script src="<?php echo ASSET_SAYA ?>js/jstree/dist/jstree.min.js"></script>
	<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>js/jstree/dist/themes/default/style.min.css" />
	<link rel="stylesheet" href="<?php echo ASSET_SAYA ?>jOrgChart/css/jquery.jOrgChart.css"/>
	<script src="<?php echo ASSET_SAYA ?>jOrgChart/jquery.jOrgChart.js"></script>
	<script src="<?php echo ASSET_SAYA ?>datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo ASSET_SAYA ?>datepicker/bootstrap-clockpicker.min.js"></script>


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
                <script>
                    function confirmBox(){
                        
                            var txt;
                            var r = confirm("Anda yakin ingin menghapus data ini ? ");
                            if (r == true) {
                                return true;
                            } else {
                                return false;
                            }
                    
                    }
	
                </script>
	</head>