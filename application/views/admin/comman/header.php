<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>GotStar - Live Streaming App</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
  <!-- Pignose Calender -->
  <link href="<?php echo base_url();?>assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
  <!-- Chartist -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/chartist/css/chartist.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
  <!-- Custom Stylesheet -->
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
  <!-- Custom Stylesheet -->
  <link href="<?php echo base_url();?>assets/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <script src="<?php echo base_url();?>assets/plugins/common/common.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/settings.js"></script>
  <script src="<?php echo base_url();?>assets/js/gleek.js"></script>
  <script src="<?php echo base_url();?>assets/js/styleSwitcher.js"></script>
  <script src="<?php echo base_url();?>assets/js/dashboard/dashboard-2.js"></script>    
  <script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweetalert.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/sweetalert/js/sweetalert.init.js"></script>

   <!-- Chartjs -->
  <script src="<?php echo base_url();?>assets/plugins/chart.js/Chart.bundle.min.js"></script>
        <!-- Circle progress -->
  <script src="<?php echo base_url();?>assets/plugins/circle-progress/circle-progress.min.js"></script>
        <!-- Datamap -->
  <script src="<?php echo base_url();?>assets/plugins/d3v3/index.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/topojson/topojson.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/datamaps/datamaps.world.min.js"></script>
        <!-- Morrisjs -->
  <script src="<?php echo base_url();?>assets/plugins/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/morris/morris.min.js"></script>
        <!-- Pignose Calender -->
  <script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
        <!-- ChartistJS -->
  <script src="<?php echo base_url();?>assets/plugins/chartist/js/chartist.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/dashboard/dashboard-1.js"></script>

</head>

<body>
  <div >

    <div class="nav-header">
      <div class="brand-logo">
        <a href="index.html">
          <b class="logo-abbr"><img src="<?php echo base_url();?>assets/images/logo.png" alt=""> </b>
          <span class="logo-compact"><img src="<?php echo base_url();?>assets/images/logo-compact.png" alt=""></span>
          <span class="brand-title">
            <img src="<?php echo base_url();?>assets/images/logo-text.png" alt="">
          </span>
        </a>
      </div>
    </div>

    <div class="header">    
      <div class="header-content clearfix">

        <div class="nav-control">
          <div class="hamburger">
            <span class="toggle-icon"><i class="icon-menu"></i></span>
          </div>
        </div>

        <div class="header-left">
          <div class="input-group icons">
            <div class="drop-down animated flipInX d-md-none">
              <form action="#">
                <input type="text" class="form-control" placeholder="Search">
              </form>
            </div>
          </div>
        </div>

        <div class="header-right">
          <ul class="clearfix">
        <li class="icons dropdown">
          <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
            <span class="activity active"></span>
            <img src="<?php echo base_url();?>assets/images/user/1.png" height="40" width="40" alt="">
          </div>
          <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
            <div class="dropdown-content-body">
              <ul>
                <li>
                  <a href="<?php echo base_url();?>index.php/admin/userlist"><i class="icon-user"></i> <span>Profile</span></a>
                </li>
                <hr class="my-2">
                <li><a href="<?php echo base_url();?>index.php/admin/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>

  </div>
</div>
</div>
</body>
</html>