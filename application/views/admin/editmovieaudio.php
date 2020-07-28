<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Update Tv show Episode</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Tv Show</a></li>
					<li class="breadcrumb-item active" aria-current="page">Update Tv Show Episode</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/movievideolist" class="btn btn-outline-primary waves-effect waves-light">Movie Video List</a>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<?php $vid=$tvshowepisodelist[0]; ?>
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Update Movie Video</div>
						<hr>
						<form id="add_tvshow_form"   onsubmit="saveTvshow();return false;"  enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="input-1">Movie Video Title</label>
								<input type="text" required value="<?php echo $vid->tvv_name; ?>" class="form-control" name="episode_title" id="input-1" placeholder="Enter Tv show Name">
							</div>

							<input type="hidden" name="id" value="<?php echo $vid->tvv_id;?>">

							<div class="form-group">
								<label for="input-2">Movie Video Name</label>
								<!-- DropDown -->
								<select name="tvshow_category" required  class="form-control">
									<option value="">Select Show</option>
									<?php foreach($tvshowlist as $cat){ ?>
										<option value="<?php echo $cat->tvs_id; ?>" <?php if($cat->tvs_id==$vid->ftvs_id ){ echo 'selected="selected"'; } ?> ><?php echo $cat->tvs_name?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="input-1">Movie Video thumbnail</label>
								<input type="file" class="form-control" name="tvshow_thumbnail" id="input_thumb" placeholder="select tvshow image">
								<input type="hidden" name="video_thumbnailimage" value="<?PHP echo $vid->tvv_thumbnail; ?>">
								<div><img src="<?php echo base_url().'assets/images/serial/'.$vid->tvv_thumbnail; ?>" height="100px;" width="100px;"></div>
							</div>

							<div class="form-group">
								<label for="input-2">Video Type</label>
								<select name="video_type" required onchange="checkVtype(this.value)" class="form-control" >
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
									<label for="input-1">Movie url</label>
									<input type="text" required  value="<?php echo $vid->tvv_video_url;?>" class="form-control" name="show_url" id="input-1" placeholder="Enter Video url">
								<?php } ?>
								<div class="msg2" style="margin-top: 1%">
									<label for="input-2" value="">
										<?php if(empty($vid->tvv_video)){}else{
											echo base_url().'assets/images/serial/'. $vid->tvv_video;
										} ?>
									</label>
								</div>
							</div>

							<div class="form-group" >
								<label for="input-1">Movie Video Descripation</label>
								<input  style="height:100px"; type="text" required value="<?php echo $vid->tvv_description;?>" class="form-control" name="episode_desc" id="input-1" placeholder="Enter Episode Descripation" >
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary shadow-primary px-5">Save</button>
							</div>

						</form>
					</div>
				</div>
			</div></div></div>
		</div>

		<?php
		$this->load->view('admin/comman/footerpage');
		?>
		<script type="text/javascript">

			function checkVtype(server){
				if(server!='Server Video'){
					$('#videoLink').html('<div class="form-group" ><label for="input-1">Episode url</label><input type="text" value="<?PHP echo $vid->tvv_video_url; ?>" class="form-control" name="show_url" id="channel_url" placeholder="Enter Server Video URL"></div> ');
				}else{
					$('#videoLink').html('<div class="form-group" id="videoLink"><label for="input-1">Upload Episode Video</label><input type="hidden" name="mp3_file_name" id="mp3_file_name" value="<?php echo $vid->tvv_video;?>" class="form-control"><input type="file" name="mp3_local" id="mp3_local" value="" class="form-control"><div class="progress" style="margin-top:1%"><div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div></div><div class="msg"></div><input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%" /><div class="msg2" style="margin-top: 1%"><label for="input-2" value=""><?php if(empty($vid->tvv_video)){}else{echo base_url().'assets/images/serial/'. $vid->tvv_video;} ?></label></div>');
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
					url:'<?php echo base_url(); ?>index.php/admin/updatemovievideo',
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