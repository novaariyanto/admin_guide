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
            				<li class="breadcrumb-item"><a href="javascript:void(0)">Sport</a></li>
            				<li class="breadcrumb-item active"><a href="javascript:void(0)">Add Sport video</a></li>
            			</ol>
            		</div>
            	</div>
            	<!-- row -->

            	<div class="container-fluid">
            		<div class="row">
            			<div class="col-12">
            				<div class="card">
            					<div class="card-body">
            						<h4 class="card-title">Add Sport Clip</h4>

            						<form id="add_tvshow_form"   onsubmit="saveTvshow();return false;"  enctype="multipart/form-data">

            							<div class="form-group">
            								<label for="input-1">Sport Name</label>
            								<input type="text" required value="" class="form-control" name="episode_title" id="input-1" placeholder="Enter Tv show Name">
            							</div>

                                        <div class="form-group">
                                            <label for="input-2">Sport Category</label>
                                            <!-- DropDown -->
                                            <select name="tvshow_category" required  class="form-control">
                                                <option value="">Select Category</option>
                                                <?php $i=1;foreach($categorylist as $cat){ ?>
                                                    <option value="<?php echo $cat->c_id; ?>"><?php echo $cat->cat_name; ?></option>            
                                                    <?php $i++;} ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                               <label for="input-1">Sport thumbnail</label>
                                               <input type="text" required  class="form-control" name="tvshow_thumbnail" id="input-1" placeholder="select tvshow image">
                                           </div>

                                           <div class="form-group">
                                               <label for="input-2">Video Type</label>

                                               <select name="video_type" required onchange="checkVtype(this.value)" class="form-control">
                                                 
                                                  <option value="Facebook Video">Facebook Video</option>
                                                  <option value="Server Video">Server Video</option>
                                                  <option value="Youtube Video">Youtube Video</option>
                                                  <option value="Vimeo Video">Vimeo Video</option>
                                                  <option value="Daily Motion">Daily Motion</option>
                                              </select>
                                          </div>

                                          <div class="form-group" id="videoLink">
                                          <div class="form-group" ><label for="input-1">Episode url</label><input type="text" value="" class="form-control" name="show_url" id="channel_url" placeholder="Enter Server Video URL"></div> 
                                           <!-- <label for="input-1">Upload Sport Video</label>

                                           <input type="hidden" name="mp3_file_name" id="mp3_file_name" value="" class="form-control">
                                           <input type="file" name="mp3_local" id="mp3_local" value="" class="form-control">

                                           <div class="progress">
                                              <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                                          </div>

                                          <div class="msg"></div>
                                          <input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%"  /> -->
                                      </div>

                                      <div class="form-group" >
                                       <label for="input-1">Sport Descripation</label>
                                       <input  style="height:100px"; type="text" required value="" class="form-control" name="episode_desc" id="input-1" placeholder="Enter Episode Descripation" >
                                   </div>

                                   <div class="form-group">
                                       <div class="demo-checkbox">
                                          <input type="checkbox" id="feature-checkbox" value="1" name="feature_video" class="filled-in chk-col-primary" />
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
        			$('#videoLink').html('<div class="form-group" ><label for="input-1">Episode url</label><input type="text" value="" class="form-control" name="show_url" id="channel_url" placeholder="Enter Server Video URL"></div> ');
        		}else{
						// $('#videoLink').html('<label for="input-1">Upload Video</label><input type="file" required  class="form-control" name="video_upload" id="input-1" placeholder="Enter Video Name">');
						$('#videoLink').html('<label for="input-1">Upload Video</label><input type="hidden" name="mp3_file_name" id="mp3_file_name" value="" class="form-control"><input type="file" name="mp3_local" id="mp3_local" value="" class="form-control"><div class="progress"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg"></div><input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%"  /> ');
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
						url:'<?php echo base_url(); ?>index.php/admin/savesportclip',
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
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