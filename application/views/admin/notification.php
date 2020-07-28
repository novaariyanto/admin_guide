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
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Notification</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->

            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Send Notification</h4>

            						<form id="savenotifi"  enctype="multipart/form-data">
            							<div class="form-group">
            								<label for="input-1">Title</label>
            								<input type="text" required  class="form-control" required="" name="title" id="input-1" placeholder="Enter title">
            							</div>

            							<div class="form-group">
            								<label for="input-2">Message</label>
            								<textarea name="message"  class="form-control"></textarea>
            							</div>


            							<div class="form-group">
            								<label for="input-1">Image (Optional)</label>
            								<input type="text" required  class="form-control" name="video_thumbnail" id="input-1" placeholder="Enter Video Name">
            							</div>

            							<div class="form-group">
            								<button type="button" onclick="saveNotification()" class="btn btn-primary shadow-primary px-5"> Save</button>
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

        <script>
        	function saveNotification(){
        		$("#dvloader").show();
        		var formData = new FormData($("#savenotifi")[0]);
        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/savenotification',
        			data:formData,
        			dataType: "json",
        			cache:false,
        			contentType: false,
        			processData: false,
        			success:function(resp){
        				document.getElementById("savenotifi").reset();
        				$("#dvloader").hide();
        				toastr.success('Notification send successfully.');   	   
        				setTimeout(function(){ location.reload(); }, 500);
        			},
        			error: function(XMLHttpRequest, textStatus, errorThrown) {
        				$("#dvloader").hide();
        				alert("".textStatus);
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