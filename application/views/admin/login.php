<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>GotStar Live Streming Mobile App</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon.png">
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet"/>

</head>

<body class="h-100">
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

        <div class="login-form-bg h-100">
          <div class="container h-100">
            <div class="row justify-content-center h-100">
              <div class="col-xl-6">
                <div class="form-input-content">
                  <div class="card login-form mb-0">
                    <div class="card-body pt-5">
                      <a class="text-center" href="index.html"> <h4>GOTSTAR</h4></a>

                      <form class="mt-5 mb-5 login-input">
                        <div class="form-group">
                         <input type="email" name="email" id="email" class="form-control" placeholder="email address" value="admin@gmail.com">
                       </div>
                       <div class="form-group">
                        <input type="password" id="password" name="password" id="exampleInputPassword" class="form-control" placeholder="Password"
                        value="12345">
                      </div>
                      <div class="form-group">
                       <button  onclick="login_ajax()" class="btn login-form__btn submit w-100">Sign In</button>
                     </div>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>

    <!--**********************************
        Scripts
        ***********************************-->
        <script src="<?php echo base_url();?>assets/plugins/common/common.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/settings.js"></script>
        <script src="<?php echo base_url();?>assets/js/gleek.js"></script>
        <script src="<?php echo base_url();?>assets/js/styleSwitcher.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
        <link href="<?php echo base_url();?>assets/css/app-style.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>assets/css/toastr.min.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
  
    function login_ajax(){
        console.log('test');
      var email = $("#email").val();
      var password = $("#password").val();
      if(email == '') {
        toastr.error('Please enter email address.');
        $("#email").focus();
        return false;
      } else if(!validateEmail($("#email").val())) {
        toastr.error('Please enter valid email address');
        $("#email").focus();
        return false;
      } else if(password == '') {
        toastr.error('Please enter password.');
        $("#password").focus();
        return false;
      } else {
        if($("#remember_me").is(":checked"))
        {
          var remember_me = 1;
        }
        else{
          var remember_me = 0;
        }
        var dataString = "email=" + email + "&password=" + password ;

        $.ajax({
          type: 'post',
          url: '<?php  header('Access-Control-Allow-Origin: *'); echo base_url() ?>index.php/admin/adminlogin',
          data: dataString,
          dataType: 'json', 
          success: function (data) {
            if(jQuery.trim(data)=='100') {
              window.location.replace("<?php echo base_url() ?>index.php/admin/dashboard");
            }else{
              toastr.error('Please enter valid email adress and password.');
              alert(data);
            }
          },
             error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });
      }
      event.preventDefault();
      return false;
} 
    
    function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

</script>
      </body>
      </html>





