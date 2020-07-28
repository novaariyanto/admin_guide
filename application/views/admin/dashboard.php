
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
          <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="1" />
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

             <div class="container-fluid">

              <div class="row">

                <?php $vid=$tvshow[0]; ?>
                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-1">
                    <div class="card-body">
                      <h3 class="card-title text-white">TV Shows</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $tvshow;?></h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-tv"></i></span>
                    </div>
                  </div>
                </div>

                <?php $vid=$tvshowvideo[0]; ?>
                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-2">
                    <div class="card-body">
                      <h3 class="card-title text-white">TV Show Episodes</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $tvshowvideo;?></h2>
                        <p class="text-white mb-0">Jan - Oct 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-tv"></i></span>
                    </div>
                  </div>
                </div>

                <?php $vid=$movielist[0]; ?>
                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-3">
                    <div class="card-body">
                      <h3 class="card-title text-white">Total Movies</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $movielist;?></h2>
                        <p class="text-white mb-0">Jan - Octo 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-film"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-4">
                    <div class="card-body">
                      <h3 class="card-title text-white">Total Sport Clips</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $sportlist;?></h2>
                        <p class="text-white mb-0">Jan - Sept 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-futbol-o"></i></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-7">
                    <div class="card-body">
                      <h3 class="card-title text-white">Total Live News</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $newslist;?></h2>
                        <p class="text-white mb-0">Jan - July 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-newspaper-o"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-4">
                    <div class="card-body">
                      <h3 class="card-title text-white">Total Caregory</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $category;?></h2>
                        <p class="text-white mb-0">Jan - Sept 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-list-alt"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-9">
                    <div class="card-body">
                      <h3 class="card-title text-white">Total Live Channel</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $channellist;?></h2>
                        <p class="text-white mb-0">Jan - Octo 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-tv"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                  <div class="card gradient-1">
                    <div class="card-body">
                      <h3 class="card-title text-white">Register User</h3>
                      <div class="d-inline-block">
                        <h2 class="text-white"><?php echo $register_user;?></h2>
                        <p class="text-white mb-0">Jan - Sept 2019</p>
                      </div>
                      <span class="float-right display-5 opacity-5"><i class="fa fa-futbol-o"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <!--Start Dashboard Content-->
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

      </body>

      </html>