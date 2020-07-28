<?php
$this->load->view('admin/comman/header');
?>



<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Wallpaper Update</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Wallpaper</a></li>
					<li class="breadcrumb-item active" aria-current="page">update wallpaper</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/wallpaperlist" class="btn btn-outline-primary waves-effect waves-light">Wallpaper List</a>


				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<?php $vid=$wallpaperlist[0]; ?>
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Add Video</div>
						<hr>
						<form id="edit_video_form"  enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="input-1">Wallpaper Name</label>
								<input type="text" required value="<?php echo $vid->title; ?>" class="form-control" name="wallpaper_title" id="input-1" placeholder="Enter Video Name">
							</div>

							<input type="hidden" name="id" value="<?PHP echo $vid->id; ?>">

							<div class="form-group">
								<label for="input-3">Wallpaper Cost</label>
								<select name="wall_cost" required  class="form-control" id="purpose">
									<option value="Free" <?php if ($vid->status == "Free" ) echo 'selected' ; 	?>>Free</option>
									<option value="Paid" <?php if ($vid->status == "Paid" ) echo 'selected' ; ?>>Paid</option>
								</select>
							</div>

							<div class="form-group" id="business" style="display:none">
								<label for="input-1">Wallpaper point</label>
								<input type="text" required value="<?php echo $vid->point; ?>" class="form-control" name="wall_point" id="input-1" placeholder="Enter Wallpaper Point">
							</div>

							<div class="form-group">
								<label for="input-2">Wallpaper Category</label>

								<select name="wall_category" required  class="form-control">
									<option value="">Select Category</option>
									<?php foreach($categorylist as $cat){ ?>
										<option value="<?php echo $cat->id; ?>" <?php if($cat->id==$vid->id ){ echo 'selected="selected"'; } ?> ><?php echo $cat->Name?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="input-3">Wallpaper Type (Optional)</label>
								<select name="wall_type" required  class="form-control">
									<option value="" >Select Type</option>
									<option value="Portrait" <?php if ($vid->field == "Portrait" ) echo 'selected' ; ?> >Portrait</option>
									<option value="Landscape" <?php if ($vid->field == "Landscape" ) echo 'selected' ; ?> >Landscape</option>
									<option value="Square"<?php if ($vid->field == "Square" ) echo 'selected' ; ?> >Square</option>
								</select>
							</div>

							<div class="form-group">
								<label for="input-1"> Wallpaper Image</label>
								<input type="file" required  class="form-control" name="wallpaper_thumbnail" id="input-1" placeholder="Enter Video Name">
								<input type="hidden" name="video_thumbnailimage" value="<?PHP echo $vid->imagepath; ?>">
								<div><img src="<?php echo base_url().'assets/images/wallpaper/'.$vid->imagepath; ?>" height="100px;" width="100px;"></div>
							</div>

							<div class="form-group">
								<button type="button" onclick="update_wallpaper()" class="btn btn-primary shadow-primary px-5"> Update</button>
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

			function update_wallpaper(){
				var wallpaper_title=jQuery('input[name=wallpaper_title]').val();
				if(wallpaper_title==''){
					toastr.error('Please enter wallpaper title','failed');
					return false;
				}
				$("#dvloader").show();

				var formData = new FormData($("#edit_video_form")[0]);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url(); ?>index.php/admin/update_wallpaper',
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					dataType: "json",
					success:function(resp){
						if(resp.status=='200'){
							$("#dvloader").hide();
							document.getElementById("edit_video_form").reset();
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