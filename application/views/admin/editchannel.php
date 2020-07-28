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
            				<li class="breadcrumb-item"><a href="javascript:void(0)">Channel</a></li>
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Channel List</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->
            	<?php $cid=$channellist[0]; ?>
            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Update Channel</h4>

            						<form id="edit_channel_form" onsubmit="update_channel()"  enctype="multipart/form-data">

            							<div class="form-group">
            								<label for="input-1">Channel Name</label>
            								<input type="text" required value="<?php echo $cid->channel_name; ?>" class="form-control" name="channel_title" id="input-1" placeholder="Enter channel name">
            							</div>

            							<input type="hidden" name="id" value="<?PHP echo $cid->id; ?>">

            							<div class="form-group">
            								<label for="input-1">Channel Descripatiom</label>
            								<textarea  required  class="form-control" name="channel_desc" id="input-1" ><?php echo $cid->channel_desc; ?></textarea> 
            							</div>

            							<div class="form-group" >
            								<label for="input-1">Channel url</label>
            								<input type="text" required value="<?php echo $cid->channel_url; ?>" class="form-control" name="channel_url" id="channel_url" placeholder="Enter channel url">
            							</div>

            							<div class="form-group">
            								<label for="input-1">Channel Image</label>
            								<input type="text" class="form-control" name="channel_thumbnail" id="input-1" value="<?PHP echo $cid->channel_image; ?>">
            								<input type="hidden" name="channel_thumbnailimage" value="<?PHP echo $cid->channel_image; ?>">
            								<div><img src="<?php echo $cid->channel_image; ?>" height="100px;" width="100px;"></div>
            							</div>

            							<div class="form-group">
            								<div class="demo-checkbox">
            									<input type="checkbox" id="feature-checkbox" <?php if($cid->is_premium =='1'){ echo 'checked="checked"'; }?> name="feature_video" class="filled-in chk-col-primary" value="1" />
            									<label for="feature-checkbox">Premium Channel</label>
            								</div>
            							</div> 

            							<div class="form-group">
            								<button type="submit"  class="btn btn-primary shadow-primary px-5"> Update</button>
            							</div>

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

			function update_channel(){
				var channel_title=jQuery('input[name=channel_title]').val();
				if(channel_title==''){
					toastr.error('Please enter channel title','failed');
					return false;
				}
				$("#dvloader").show();

				var formData = new FormData($("#edit_channel_form")[0]);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url(); ?>index.php/admin/update_channel',
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					dataType: "json",
					success:function(resp){
						if(resp.status=='200'){
							$("#dvloader").hide();
							//document.getElementById("edit_channel_form").reset();
							toastr.success(resp.msg,'success');                 setTimeout(function(){ location.reload(); }, 500);
						}else{
							$("#dvloader").hide();
							toastr.error(resp.msg);
						}


					}
				});

			}
			function checkVtype(server){
				if(server!='Server Video'){
					$('#videoLink').html('<label for="input-1">Video url</label><input type="text" required  class="form-control" name="video_url" id="input-1" placeholder="Enter Video url">');
				}else{
					$('#videoLink').html('<label for="input-1">Upload Video</label><input type="file" required  class="form-control" name="video_upload" id="input-1" placeholder="Enter Video Name">');
				}
			}
		</script>
        
    </body>

    </html>