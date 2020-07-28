<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>
s
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Add Tv Show Episode</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="javaScript:void();">Tv show</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Tv show Episode</li>
        </ol>
      </div>
      <div class="col-sm-3">
        <div class="btn-group float-sm-right">
          <a href="<?php echo base_url();?>index.php/admin/tvshowlist" class="btn btn-outline-primary waves-effect waves-light">Tv Show List</a>
        </div>
      </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <div class="card-title">Add Tv Show Episode</div>
            <hr>
            <form id="add_tvshow_form"   onsubmit="saveTvshow()"  enctype="multipart/form-data">
              
              <div class="form-group">
                <label for="input-1">Tv Show Name</label>
                <input type="text" required value="" class="form-control" name="tvshow_title" id="input-1" placeholder="Enter Tv show Name">
              </div>


              <div class="form-group" >
                <label for="input-1">Tv Show type</label>
                <select class="form-control" name="showtype">
                  <option value="">Select Type</option>
                  <option value="tv">TV</option>
                  <option value="Movie">Movie</option>
                  <option value="News">News</option>
                  <option value="Sports">Sports</option>
                </select>
              </div>

              <div class="form-group">
                <label for="input-2">Tv show Category</label>
                <!-- DropDown -->
                <select name="tvshow_category" required  class="form-control">
                  <option value="">Select Category</option>
                  <?php $i=1;foreach($categorylist as $cat){ ?>
                    <option value="<?php echo $cat->c_id; ?>"><?php echo $cat->cat_name; ?></option>            
                    <?php $i++;} ?>
                  </select>
                </div>
 

                <div class="form-group">
                  <label for="input-1">Tv show thumbnail</label>
                  <input type="file" required  class="form-control" name="tvshow_thumbnail" id="input-1" placeholder="select tvshow image">
                  
                  <!--<div><img src="" height="100px;" width="100px;"></div>-->
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
            url:'<?php echo base_url(); ?>index.php/admin/savetvshow',
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
      </script>