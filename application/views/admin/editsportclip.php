<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Update Sport Show</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Sport Show</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Sport Show</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/tvshowlist" class="btn btn-outline-primary waves-effect waves-light">Sport Show List</a>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Update Sport Show</div>
						<hr>
						<form id="edit_tvshow_form" onsubmit="savetvshow();return false;"  enctype="multipart/form-data">
							
							<?php $tvs=$tvshowlist[0];?>
							<div class="form-group">
								<label for="input-1">Sport Show Name</label>
								<input type="text" required value="<?php echo $tvs->tvs_name;?>" class="form-control" name="tvshow_title" id="input-1" placeholder="Enter Tv show Name">
							</div>
							<input type="hidden" name="id" value="<?php echo $tvs->tvs_id;?>">

							<div class="form-group" >
								<label for="input-1">Sport Show type</label>
								<select class="form-control" name="showtype">
									<option value="">Select Type</option>
									<option value="tv" <?php if($tvs->type=='tv'){ echo 'selected="selected"'; } ?> >TV</option>
									<option value="Movie"  <?php if($tvs->type=='Movie'){ 'selected="selected"';} ?>>Movie</option>
									<option value="News"  <?php if($tvs->type=='News'){ echo 'selected="selected"'; } ?> >News</option>
									<option value="Sports"  <?php if($tvs->type=='Sports'){ echo 'selected="selected"'; } ?>>Sports</option>
								</select>
							</div>

							<div class="form-group">
								<label for="input-2">Sport show Category</label>
								<!-- DropDown -->
								<select name="tvshow_category" required  class="form-control">
									<option value="">Select Category</option>
									<?php $i=1;
									foreach($categorylist as $cat){ ?>
										<option value="<?php echo $cat->c_id; ?>" <?php if($cat->c_id==$tvs->fc_id){ echo 'selected="selected"';} ?>><?php echo $cat->cat_name; ?></option>            
										<?php $i++;} ?>
									</select>
								</div>

								<div class="form-group">
									<label for="input-1"> Sport Show thumbnail</label>
									<input type="text"  class="form-control" name="tvshow_thumbnail" id="input-1" value="<?php echo $tvs->tvs_image;?>" placeholder="select wallpaper image">
									<input type="hidden" name="tvshow_thumbnail_imag" value="<?php echo $tvs->tvs_image;?>">
									<div><img src="<?php echo $tvs->tvs_image;?>" height="100px;" width="100px;"></div>
								</div>

								<div class="form-group">
									<button type="submit"  class="btn btn-primary shadow-primary px-5">Save</button>
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



				function savetvshow(){
					
					var tvshow_title=jQuery('input[name=tvshow_title]').val();
					if(tvshow_title==''){
						toastr.error('Please enter tv show title','failed');
						return false;
					}
					$("#dvloader").show();
					var formData = new FormData($("#edit_tvshow_form")[0]);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url(); ?>index.php/admin/update_tvshow',
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
						dataType: "json",
						success:function(resp){
							$("#dvloader").hide();
							document.getElementById("edit_tvshow_form").reset();
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