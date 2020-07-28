<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>GotStar - Live Streaming App</title>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<!-- Custom Stylesheet -->
	<link href="<?php echo base_url();?>assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
        	<div class="loader">
        		<svg class="circular" viewBox="25 25 50 50">
        			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        		</svg>
        	</div>
        </div>
    <!--*******************
        Preloader end
        ********************-->
    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

        <!--**********************************
            Nav header start
            ***********************************-->
            <?php
            $this->load->view('admin/comman/header');
            ?>
             <!--**********************************
              Sidemenu start
              ***********************************-->
              <?php
              $this->load->view('admin/comman/sidemenu');
              ?>
          <!--**********************************
            Sidemenu end
            ***********************************-->

        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">

            	<div class="row page-titles mx-0">
            		<div class="col p-md-0">
            			<ol class="breadcrumb">
            				<li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            				<li class="breadcrumb-item"><a href="javascript:void(0)">Subscription</a></li>
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Subscription</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->

            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="">
            					<div class="card-body">
            						<h4 class="card-title">Subscription</h4>

            						<div class="row">
            							<?php $i=1;foreach($subplan as $sub){ ?>
            								<div class="col-3">
            									<div class="card">
            										<div class="card-body">
            											<div class="text-center">
            												<span class="display-5"><i class="icon-diamond gradient-4-text"></i></span>
            												<h2 class="mt-3"><?php echo $sub->currency_type;?><?php echo $sub->sub_price;?></h2>
            												<p><?php echo $sub->sub_name;?></p>
            												<a href="<?php echo base_url();?>index.php/admin/editplan?id=<?php echo $sub->sub_id; ?>" class="btn gradient-4 btn-lg border-0 btn-rounded px-3">Edit</a>
            												<a onclick="delete_record('<?php echo $sub->sub_id; ?>','sub')" class="btn gradient-2 btn-lg border-0 btn-rounded px-3">Delete</a>
            											</div>
            										</div>
            									</div>
            								</div>
            								<?php $i++;} ?>
            							</div>

            						</div>
            					</div>
            				</div>
            			</div>
            			<!-- #/ container -->
            		</div>
        <!--**********************************
            Content body end
            ***********************************-->

            <?php
            $this->load->view('admin/comman/footerpage');
            ?>
        </div>
    <!--**********************************
        Main wrapper end
        ***********************************-->

    <!--**********************************
        Scripts
        ***********************************-->
        <script src="<?php echo base_url();?>assets/plugins/common/common.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/settings.js"></script>
        <script src="<?php echo base_url();?>assets/js/gleek.js"></script>
        <script src="<?php echo base_url();?>assets/js/styleSwitcher.js"></script>

        <script src="<?php echo base_url();?>assets/plugins/tables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

        <script type="text/javascript">

        	function saveTvshow(){

        		var tvshow_title=jQuery('input[name=tvshow_title]').val();
        		if(tvshow_title==''){
        			toastr.error('Please enter Tv show title','failed');
        			return false;
        		}
        		$("#dvloader").show();
        		var formData = new FormData($("#add_tvshow_form")[0]);
        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/savetvshow',
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			dataType: "json",
        			success:function(resp){
        				$("#dvloader").hide();
        				document.getElementById("add_tvshow_form").reset();
        				toastr.success(resp.msg,'success');                
        				setTimeout(function(){ location.reload(); }, 500);
        			},
        			error: function(XMLHttpRequest, textStatus, errorThrown) {
        				$("#dvloader").hide();
        				toastr.error(errorThrown.msg,'failed');         
        			}
        		});
        	}
        </script>
        
    </body>

    </html>