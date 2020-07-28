<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Add Movie Video</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Sport</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Movie Video</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/movievideolist" class="btn btn-outline-primary waves-effect waves-light">Movie Video List</a>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Add Movie Video</div>
						<hr>
						<form id="add_tvshow_form"   onsubmit="saveTvshow();return false;"  enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="input-1">Movie Video Title</label>
								<input type="text" required value="" class="form-control" name="episode_title" id="input-1" placeholder="Enter Tv show Name">
							</div>

							<div class="form-group">
								<label for="input-2">Movie Name</label>
								<!-- DropDown -->
								<select name="tvshow_category" required  class="form-control">
									<option value="">Select Show</option>
									<?php $i=1;foreach($tvshowlist as $cat){ ?>
										<option value="<?php echo $cat->tvs_id; ?>"><?php echo $cat->tvs_name; ?></option>            
										<?php $i++;} ?>
									</select>
								</div>

								<div class="form-group">
									<label for="input-1">Movie thumbnail</label>
									<input type="file" required  class="form-control" name="tvshow_thumbnail" id="input-1" placeholder="select tvshow image">
								</div>


								<div class="form-group">
									<label for="input-2">Video Type</label>

									<select name="video_type" required onchange="checkVtype(this.value)" class="form-control">
										<option value="Server Video">Server Video</option>
										<option value="Youtube Video">Youtube Video</option>
										<option value="Vimeo Video">Vimeo Video</option>
										<option value="Daily Motion">Daily Motion</option>
									</select>
								</div>

								<div class="form-group" id="videoLink">

									<label for="input-1">Upload Movie</label>

									<input type="hidden" name="mp3_file_name" id="mp3_file_name" value="" class="form-control">
									<input type="file" name="mp3_local" id="mp3_local" value="" class="form-control">

									<div class="progress">
										<div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
									</div>

									<div class="msg"></div>
									<input type="button" id="btn" class="btn-success" value="Upload" style="margin-top:1%"  />
								</div>

								<div class="form-group" >
									<label for="input-1">Movie Descripation</label>
									<input  style="height:100px"; type="text" required value="" class="form-control" name="episode_desc" id="input-1" placeholder="Enter Episode Descripation" >
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
						url:'<?php echo base_url(); ?>index.php/admin/savemovieshow',
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