<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Add Wallpaper</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Wallpaper</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Wallpaper</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/wallpaperlist" class="btn btn-outline-primary waves-effect waves-light">Wallpaper List</a>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Add Wallpaper</div>
						<hr>
						<form id="edit_video_form"  enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="input-1">Wallpaper Name</label>
								<input type="text" required value="" class="form-control" name="wallpaper_title" id="input-1" placeholder="Enter Wallpaper Name">
							</div>

							<input type="hidden" name="id" value="">

							<div class="form-group">
								<label for="input-3">Wallpaper Cost</label>
								<select name="wall_cost" required  class="form-control" id="purpose">
									<option value="Free">Free</option>
									<option value="Paid">Paid</option>
								</select>
							</div>

							<div class="form-group" id="business" style="display:none">
								<label for="input-1">Wallpaper point</label>
								<input type="text" required value="" class="form-control"  name="wall_point" id="input-1" placeholder="Enter Wallpaper Point">
							</div>

							<div class="form-group">
								<label for="input-2">Wallpaper Category</label>
								<!-- DropDown -->
								<select name="wall_category" required  class="form-control">
									<option value="">Select Category</option>
									<?php $i=1;foreach($categorylist as $cat){ ?>
										<option value="<?php echo $cat->id; ?>"><?php echo $cat->Name; ?></option>            
										<?php $i++;} ?>
									</select>
								</div>

								<div class="form-group">
									<label for="input-3">Wallpaper Type (Optional)</label>
									<select name="wall_type" required  class="form-control">
										<option value="">Select Type</option>
										<option value="Portrait">Portrait</option>
										<option value="Landscape">Landscape</option>
										<option value="Square">Square</option>
									</select>
								</div>

								<div class="form-group">
									<label for="input-1"> Wallpaper thumbnail</label>
									<input type="file" required  class="form-control" name="wallpaper_thumbnail" id="input-1" placeholder="select wallpaper image">
									<input type="hidden" name="wallpaper_image" value="">
									<!--<div><img src="" height="100px;" width="100px;"></div>-->
								</div>

								<div class="form-group">
									<button type="button" onclick="saveWallpaper()" class="btn btn-primary shadow-primary px-5">Save</button>
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

				$('#purpose').on('change', function () {
			    	if (this.value === 'Paid'){
			    		$("#business").show();
			    	} else {
			    		$("#business").hide();
			    	}
			    });

				function saveWallpaper(){
					
					var wallpaper_title=jQuery('input[name=wallpaper_title]').val();
					if(wallpaper_title==''){
					    	toastr.error('Please enter wallpaper title','failed');
					    	return false;
					}
					$("#dvloader").show();
					var formData = new FormData($("#edit_video_form")[0]);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url(); ?>index.php/admin/savewallpaper',
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
						dataType: "json",
						success:function(resp){
							$("#dvloader").hide();
							document.getElementById("edit_video_form").reset();
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