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
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Update Subscription</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->
            	<?php $sub=$subplan[0];?>
            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Update Subscription plan</h4>

            						<form id="add_channel_form" onsubmit="updateplan();return false;" enctype="multipart/form-data"> 

            							<input type="hidden" name="id" value="<?php echo $sub->sub_id;?>">

            							<div class="form-group">
            								<label>Plan Name</label>
            								<input name="plan_name" type="text" class="form-control" placeholder="Enter Plan name"
            								value="<?php echo $sub->sub_name;?>">
            							</div>

            							<div class="form-row">
            								<div class="form-group col-md-6">
            									<label>Plan Price</label>
            									<input name="plan_price" type="number" value="<?php echo $sub->sub_price;?>" class="form-control" placeholder="Plan Price">
            								</div>
            								<div class="form-group col-md-6">
            									<label>Price Type</label>
            									<select name="price_type" required onchange="checkVtype(this.value)" class="form-control">

            										<option value="$" <?php if($sub->currency_type=="$" ){ echo 'selected="selected"'; } ?>>
            										$ (USD)</option>

            										<option value="&#x20b9;" <?php if($sub->currency_type!="$" ){ echo 'selected="selected"'; } ?>>&#x20b9; (Rs)</option>

            									</select>
            								</div>
            							</div>

            							<div class="form-row">
            								<div class="form-group col-md-6">
            									<label>Plan Period</label>
            									<input value="<?php echo $sub->sub_time;?>" name="plan_period" type="number" class="form-control" placeholder="Ex. 1">
            								</div>
            								<div class="form-group col-md-6">
            									<label>Plan type</label>
            									<select name="plan_type" required onchange="checkVtype(this.value)" class="form-control">

            										<option value="year" <?php if($sub->sub_type=="year" ){ echo 'selected="selected"'; } ?>>
            										Year</option>

            										<option value="month" <?php if($sub->sub_type=="month" ){ echo 'selected="selected"'; } ?>>Month</option>

            									</select>
            								</div>
            							</div>

            							<button type="submit" class="btn btn-dark">Save</button>
            						</form>

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


        	function updateplan(){

        		$("#dvloader").show();
        		var formData = new FormData($("#add_channel_form")[0]);
        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/updateplan',
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			dataType: "json",
        			success:function(resp){
        				$("#dvloader").hide();
        				document.getElementById("add_channel_form").reset();
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