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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Channel</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Channel List</a></li>
                  </ol>
                </div>
              </div>
              <!-- row -->

              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Channel List</h4>
                        <table id="default-datatable" class="table table-bordered">
                         <thead>
                          <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Channel Url</th>
                            <th>view</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php $i=1;foreach($channellist as $channel){ ?>
                          <tr>
                           <td><?php echo $i;?></td>
                           <td><img style="width:100px;height:100px;" src="<?php echo $channel->channel_image;?>"></td>
                           <td><?php echo $channel->channel_name;?></td>
                           <td><?php echo $channel->channel_url;?></td>
                           <td><?php echo $channel->channel_view;?></td>
                           <td><a href="<?php echo base_url()?>index.php/admin/editchannel?id=<?php echo $channel->id; ?>">Edit</a> | <a href="javaScript:void(0)" onclick="delete_record('<?php echo $channel->id; ?>','channel')">Delete</a></td>
                         </tr>
                         <?php $i++;} ?>

                       </tbody>
                       <tfoot>

                        <tr>
                         <th>Id</th>
                         <th>Image</th>
                         <th>Name</th>
                         <th>Channel Url</th>
                         <th>view</th>
                         <th>Action</th>                 
                       </tr>

                     </tfoot>
                   </table>

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
          $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable();
    } );

  </script>

</body>

</html>