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
            				<li class="breadcrumb-item"><a href="javascript:void(0)">TV Show</a></li>
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add TV Show</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->

            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Add Tv Show</h4>

            						<div class="clearfix"></div>
            						<div class="row">
            							<?php $setn=array(); foreach($settinglist as $set){
            								$setn[$set->key]=$set->value;
            							}
            							?>
            							<div class="col-lg-12">
            								<div >
            									<div> 
            										<ul class="nav nav-pills nav-pills-danger nav-justified top-icon" role="tablist">
            											<li class="nav-item">
            												<a class="nav-link active show" data-toggle="pill" href="#piil-17"><i class="icon-home"></i> <span class="hidden-xs">App Setting</span></a>
            											</li>
            											<li class="nav-item">
            												<a class="nav-link" data-toggle="pill" href="#piil-18"><i class="icon-user"></i> <span class="hidden-xs">Admob Setting</span></a>
            											</li>
            											<li class="nav-item">
            												<a class="nav-link" data-toggle="pill" href="#piil-19"><i class="icon-envelope-open"></i> <span class="hidden-xs">Notification Setting</span></a>
            											</li>

            										</ul>

            										<!-- Tab panes -->
            										<div class="tab-content">
            											<div id="piil-17" class="container tab-pane active show">
            												<form id="save_setting"  enctype="multipart/form-data">
            													<div class="form-group">
            														<label for="input-1">App Name</label>
            														<input type="text" name="app_name" required class="form-control" id="input-1" placeholder="Enter Your App Name" value="<?php echo $setn['app_name'];?>">
            													</div>
            													<div class="form-group" style="margin-top: 15px">
            														<label for="input-2">App Image</label>
            														<input type="file" name="app_image" required class="form-control" id="input-2" >
            														<input type="hidden" name="app_image_logo" value="<?php echo $setn['app_logo'];?>">
            														<div><img src="<?php echo base_url().'assets/images/serial/'.$setn['app_logo'];?>" height="100px;" width="100px;"></div>
            													</div>
            													<div class="form-group">
            														<label for="input-2">App Descripation</label>
            														<textarea  name="app_desc" required class="form-control" id="input-2" ><?php echo $setn['app_desripation'];?></textarea>
            													</div>
            													<div class="form-group">
            														<label for="input-2">Host Email</label>
            														<input type="text" name="host_email" required class="form-control" id="input-2" value="<?php echo $setn['host_email'];?>">
            													</div>
            													<div class="form-group">
            														<button type="button" class="btn btn-primary shadow-primary px-5" onclick="save_setting()"> Save</button>
            													</div>
            												</form>
            											</div>

            											<div id="piil-18" class="container tab-pane fade">
            												<form id="save_admob"  enctype="multipart/form-data">
            													<div class="form-group">
            														<label for="input-1">Publisher ID</label>
            														<input type="text" name="publisher_id" required class="form-control" id="input-1" placeholder="Enter Your App Name" value="<?php echo $setn['publisher_id'];?>">
            													</div>

            													<div class="form-group">
            														<label for="input-2">Banner Ad</label>
            														<select name="banner_ad"  class="form-control" id="interstital_ad">
            															<option> Select Banner</option>
            															<option value="yes" <?php if($setn['banner_ad']=='yes'){ echo 'selected="selected"'; } ?> >Yes</option>
            															<option value="no" <?php if($setn['banner_ad']=='no'){ echo 'selected="selected"'; } ?>  >No</option>
            														</select>

            													</div>
            													<div class="form-group">
            														<label for="input-1">Banner Ad ID</label>
            														<input type="text" name="banner_ad_id" required class="form-control" id="input-1" placeholder="Enter Your App Name" value="<?php echo $setn['banner_adid'];?>">
            													</div>

            													<div class="form-group">
            														<label for="input-2">Interstital Ad</label>
            														<select name="interstital_ad"  class="form-control" id="interstital_ad">
            															<option> Select Banner</option>
            															<option value="yes" <?php if($setn['interstital_ad']=='yes'){ echo 'selected="selected"'; } ?> >Yes</option>
            															<option value="no" <?php if($setn['interstital_ad']=='no'){ echo 'selected="selected"'; } ?>  >No</option>
            														</select>
            													</div>
            													<div class="form-group">
            														<label for="input-1">Interstital Ad ID</label>
            														<input type="text" name="interstital_adid" required class="form-control" id="input-1" placeholder="Enter Your App Name" value="<?php echo $setn['interstital_adid'];?>">
            													</div>

            													<div class="form-group">
            														<label for="input-2">Interstital Ad Clicks</label>
            														<input type="text" name="interstital_adid_click" required class="form-control" id="input-2" value="<?php echo $setn['interstital_adclick'];?>">
            													</div>
            													<div class="form-group">
            														<button type="button" class="btn btn-primary shadow-primary px-5" onclick="save_admob()"> Save</button>
            													</div>
            												</form>
            											</div>
            											<div id="piil-19" class="container tab-pane fade">
            												<form id="save_signal_noti"  enctype="multipart/form-data">
            													<div class="form-group">
            														<label for="input-1">OneSignal App ID</label>
            														<input type="text" name="one_signal" required class="form-control" id="input-1" placeholder="Enter Your App Name" value="<?php echo $setn['onesignal_apid'];?>">
            													</div>

            													<div class="form-group">
            														<label for="input-2">OneSignal Rest Key</label>
            														<input type="text" name="rest_key" required class="form-control" id="input-2" value="<?php echo $setn['onesignal_rest_key'];?>">
            													</div>
            													<div class="form-group">
            														<button type="button" class="btn btn-primary shadow-primary px-5" onclick="save_signal_noti()"> Save</button>
            													</div>
            												</form>
            											</div>

            										</div>
            									</div>
            								</div>
            							</div>


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

        	function save_setting(){
        		var formData = new FormData($("#save_setting")[0]);
        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/savesetting' ,
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			success:function(resp){
             // document.getElementById("save_setting").reset();

             toastr.success('Setting saved.');
         }
     });
        	}
        	function save_admob(){
        		var formData = new FormData($("#save_admob")[0]);

        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/save_admob' ,
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			success:function(resp){
             // document.getElementById("save_admob").reset();

             toastr.success('Setting saved.');
         }
     });
        	}
        	function save_signal_noti(){
        		var formData = new FormData($("#save_signal_noti")[0]);


        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/save_signal_noti' ,
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			success:function(resp){
              //document.getElementById("save_signal_noti").reset();

              toastr.success('Setting saved.');
          }
      });
        	}
        </script>
        
    </body>

    </html>