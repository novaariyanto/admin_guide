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
</head>

<body>
  <div > 
        <!--**********************************
            Sidebar start
            ***********************************-->
            <div class="nk-sidebar">           
              <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                  <li class="nav-label">Dashboard</li>
                  <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/dashboard">Home</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/userlist">User</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/categorylist">Category</a></li>
                    </ul>
                  </li>
                  <!-- <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-globe-alt menu-icon"></i><span class="nav-text">TV Show</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addtvshow">Add TV Show</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/tvshowlist">TV Show List</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/addtvshowepisode">Add TV Show Episode</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/tvshowepisodelist">TV Show Episode List</a></li>
                    </ul>
                  </li> -->
                  <!-- <li class="nav-label">Movies</li> --> 
                  <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-envelope menu-icon"></i> <span class="nav-text">One Menus</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addmovievideo">Add One Video</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/movievideolist">One Video List</a></li>
                    </ul>
                  </li>
                  <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Two Menus</span>
                    </a> 
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addsportclip"></i> Add Two Clips </a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/sportcliplist"></i> Two Clips List</a></li>
                    </ul>
                  </li>

                  <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-graph menu-icon"></i> <span class="nav-text">News List</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addnewsclip">Add News Clips </a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/newscliplist">News Clips List</a></li>
                    </ul>
                  </li> 

                  <!-- <li class="nav-label">UI Components</li> -->
                  <!-- <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-grid menu-icon"></i><span class="nav-text">Channels</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addchannel"></i> Add Channel  </a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/channellist"></i> Channel  List</a></li>
                    </ul>
                  </li> -->
<!-- 
                  <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-note menu-icon"></i><span class="nav-text">Audios</span>
                    </a>
                    <ul aria-expanded="false">
                      <li><a href="<?php echo base_url();?>index.php/admin/addaudio">Add Audio</a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/audiolist">Audio List</a></li>
                    </ul>
                  </li> -->

                  <!-- <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-menu menu-icon"></i><span class="nav-text">Subscription</span>
                    </a>
                    <ul class="sidebar-submenu">
                      <li><a href="<?php echo base_url();?>index.php/admin/addplan">Add Subscription </a></li>
                      <li><a href="<?php echo base_url();?>index.php/admin/subscription">Subscription List</a></li>
                    </ul>
                  </li> -->
                  
                  <li>
                    <a href="<?php echo base_url();?>index.php/admin/notification" class="waves-effect">
                      <i class="fa fa-cogs"></i><span class="nav-text">Notification</span>
                    </a>
                  </li>

                  <li>
                    <a href="<?php echo base_url();?>index.php/admin/settingpage" class="waves-effect">
                      <i class="fa fa-cogs"></i><span class="nav-text">Setting</span>
                    </a>
                  </li>

                  <li>
                    <a href="<?php echo base_url();?>index.php/admin/logout" class="waves-effect">
                      <i class="icon-power mr-2"></i><span class="nav-text">Logout</span>
                      <i class="fa fa-angle-left float-right"></i>
                    </a>
                  </li>

                </ul>
              </div>
            </div>
        <!--**********************************
            Sidebar end
            ***********************************-->
          </div>
        </body>
        </html>