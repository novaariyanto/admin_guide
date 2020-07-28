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
            				<li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Update Category</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->
            	
            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Update Category</h4>

            						<form id="edit_category_form"  enctype="multipart/form-data">
            							<div class="form-group">
            								<label for="input-1">Category Name</label>
            								<input type="text" name="category_name" class="form-control" id="input-1" placeholder="Enter Your Category Name" value="<?php echo $category[0]->cat_name?>">
            							</div>
            							<input type="hidden" name="id" value="<?PHP echo $category[0]->c_id; ?>">

            							<div class="form-group">
            								<label for="input-2">Category Image</label>
            								<input type="file" name="category_image" class="form-control" id="input-2" >
            								<input type="hidden" name="categoryimage" value="<?PHP echo $category[0]->cat_image; ?>">
            								<div><img src="<?php echo base_url().'assets/images/category/'.$category[0]->cat_image; ?>" height="100px;" width="100px;"></div>
            							</div>
            							<div class="form-group">
            								<button type="button" onclick="updateCategory()" class="btn btn-primary shadow-primary px-5">Update</button>
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
        	function updateCategory(){
        		var category_name=jQuery('input[name=category_name]').val();
        		if(category_name==''){
        			toastr.error('Please enter category name','failed');
        			return false;
        		}
        		$("#dvloader").show();

        		var formData = new FormData($("#edit_category_form")[0]);
        		$.ajax({
        			type:'POST',
        			url:'<?php echo base_url(); ?>index.php/admin/updatecategory',
        			data:formData,
        			cache:false,
        			contentType: false,
        			processData: false,
        			success:function(resp){
        				toastr.success('update category suceessfully..');
        				$("#dvloader").hide();

        				setTimeout(function(){ location.reload(); }, 500);
        			}
        		});
        	}
        </script>
        
    </body>

    </html>