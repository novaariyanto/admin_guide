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
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Tv Show Episode</a></li>
            			</ol>
            		</div>
            	</div>

            	<!-- row -->
            	<?php $vid=$tvshowepisodelist[0]; ?>
            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Add Tv Episode</h4>

            						<form id="add_tvshow_form"   onsubmit="saveTvshow()"  enctype="multipart/form-data">

            							<div class="form-group">
            								<label for="input-1">Episode Name</label>
            								<input type="text" required value="<?php echo $vid->tvv_name; ?>" class="form-control" name="episode_title" id="input-1" placeholder="Enter Tv show Name">
            							</div>

            							<input type="hidden" name="id" value="<?php echo $vid->tvv_id;?>">

            							<div class="form-group">
            								<label for="input-2">Tv show Name</label>
            								<!-- DropDown -->
            								<select name="tvshow_category" required  class="form-control">
            									<option value="">Select Show</option>
            									<?php foreach($tvshowlist as $cat){ ?>
            										<option value="<?php echo $cat->tvs_id; ?>" <?php if($cat->tvs_id==$vid->ftvs_id ){ echo 'selected="selected"'; } ?> ><?php echo $cat->tvs_name?></option>
            									<?php } ?>
            								</select>
            							</div>

            							<div class="form-group">
            								<label for="input-1">Episode thumbnail</label>
            								<input type="text" class="form-control" name="tvshow_thumbnail" value="<?PHP echo $vid->tvv_thumbnail; ?>" id="input_thumb" placeholder="select tvshow image">
            								<input type="hidden" name="videothumbnailimage" value="<?PHP echo $vid->tvv_thumbnail; ?>">
            								<div><img src="<?php echo $vid->tvv_thumbnail; ?>" height="100px;" width="100px;"></div>
            							</div>

            							<div class="form-group">
            								<label for="input-2">Video Type</label>
            								<select name="video_type" required onchange="checkVtype(this.value)" class="form-control" >
												<option value="Link Video" <?php if('Link Video'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Link Video</option>
												<option value="Facebook Video" <?php if('Facebook Video'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Facebook Video</option>
												<option value="Server Video" <?php if('Server Video'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Server Video</option>
            									<option value="Youtube Video" <?php if('Youtube Video'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Youtube Video</option>
            									<option value="Vimeo Video" <?php if('Vimeo Video'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Vimeo Video</option>
            									<option value="Daily Motion" <?php if('Daily Motion'==$vid->tvv_video_type )
            									{ echo 'selected="selected"'; } ?>>Daily Motion</option>
            								</select>
            							</div>

            							<div class="form-group" id="videoLink">
            								<?php if($vid->tvv_video_type =='Server Video'){ ?>
            									<label for="input-1">Upload Episode Video</label>
            									<input type="hidden" name="mp3_file_name" id="mp3_file_name" value="<?php echo $vid->tvv_video;?>" class="form-control">
            									<input type="file" name="mp3_local" id="mp3_local" value="" class="form-control">
            									<div class="progress">
            										<div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
            									</div>
            									<div class="msg" style="margin-top: 1%"></div>
            									<input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%">
            								<?php }else{ ?>
            									<label for="input-1">Video url</label>
            									<input type="text" required  value="<?php echo $vid->tvv_video_url;?>" class="form-control" name="show_url" id="input-1" placeholder="Enter Video url">
            								<?php } ?>
            								<div class="msg2" style="margin-top: 1%">
            									<label for="input-2" value="">
            										<?php if(empty($vid->tvv_video)){}else{
            											echo $vid->tvv_video;
            										} ?>
            									</label>
            								</div>
            							</div>

            							<div class="form-group" >
            								<label for="input-1">Episode Descripation</label>
            								<input  style="height:100px"; type="text" required value="<?php echo $vid->tvv_description;?>" class="form-control" name="episode_desc" id="input-1" placeholder="Enter Episode Descripation" >
            							</div>

            							<div class="form-group">
            								<div class="demo-checkbox">
            									<input type="checkbox" id="feature-checkbox" <?php if($vid->is_premium =='1'){ echo 'checked="checked"'; }?> name="feature_video" class="filled-in chk-col-primary" value="1" />
            									<label for="feature-checkbox">Premium Video</label>
            								</div>
            							</div>  

            							<div class="form-group">
            								<button type="submit" class="btn btn-primary shadow-primary px-5">Save</button>
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

        	function checkVtype(server){
        		if(server!='Server Video'){
        			$('#videoLink').html('<div class="form-group" ><label for="input-1">Episode url</label><input type="text" value="<?PHP echo $vid->tvv_video_url; ?>" class="form-control" name="show_url" id="channel_url" placeholder="Enter Server Video URL"></div> ');
        		}else{
        			$('#videoLink').html('<label for="input-1">Upload Episode Video</label><input type="hidden" name="mp3_file_name" id="mp3_file_name" value="<?php echo $vid->tvv_video;?>" class="form-control"><input type="file" name="mp3_local" id="mp3_local" value="" class="form-control"><div class="progress"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg" style="margin-top: 1%"></div><input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%">');
        		}
        	}

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
        			url:'<?php echo base_url(); ?>index.php/admin/updatetvshowEpisode',
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
        	jQuery(function ($) {
        		$('#btn').click(function () {
        			$('.myprogress').css('width', '0');
        			$('.msg').text('');

        			var mp3_local = $('#mp3_local').val();
        			if (mp3_local == '') {
        				alert('Please enter file name and select file');
        				return;
        			}
        			var formData = new FormData(); 

        			formData.append('mp3_local', $('#mp3_local')[0].files[0]);
        			$('#btn').attr('disabled', 'disabled');
        			$('.msg').text('Uploading in progress...');

        			$.ajax({
        				url: '<?php echo base_url() ?>index.php/admin/Savevideos',
        				data: formData,
        				processData: false,
        				contentType: false,
        				type: 'POST',
                        // this part is progress bar
                        xhr: function () {
                        	var xhr = new window.XMLHttpRequest();
                        	xhr.upload.addEventListener("progress", function (evt) {
                        		if (evt.lengthComputable) {
                        			var percentComplete = evt.loaded / evt.total;
                        			percentComplete = parseInt(percentComplete * 100);
                        			$('.myprogress').text(percentComplete + '%');
                        			$('.myprogress').css('width', percentComplete + '%');
                        		}
                        	}, false);
                        	return xhr;
                        },
                        success: function (data) {
                        	$('#mp3_local').val('');
                        	$('#mp3_file_name').val(data);
                        	$('.msg').text("File uploaded successfully!!");
                        	$('#btn').removeAttr('disabled');
                        }
                    });
        		});
        	});
        </script>
    </body>

    </html>