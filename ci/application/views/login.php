<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  </head>

  <body class="bg-dark">
<script>
var base_url="<?php echo base_url()?>";
  $(document).ready(function(){
    $('#loginBtn').click(function(){

      function ValidateEmail(mail) 
      {
      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        {
          return (true)
        }
      //   alert("You have entered an invalid email address!")
          return (false)
      }

      var email=$('#inputEmail').val();
      var password=$('#inputPassword').val();
      if(email.length==0 || password.length==0)
      {
        $('#warning-box').hide();
        $('#warning-box').html('username and password cannot be empty');
        $('#warning-box').show('slow');
        return;
      }
      else if(!ValidateEmail(email))
      {
        $('#warning-box').hide();
        $('#warning-box').html('enter a valid email');
        $('#warning-box').show('slow');
        return;
      }
      $.ajax({
          url:"<?php echo base_url() ?>index.php/Welcome/loginUser",
          success:function(data){
            //alert(data);         
            data=JSON.parse(data);
            if(data.result=="0")
            {
              $('#warning-box').hide();
              $('#warning-box').html('login failed! incorrrect credentials');
              $('#warning-box').show('slow');
            }
            else{
              //alert('x');
              if(data.result=='1')
              {
                window.location.replace(base_url+'index.php/HomePage/loadPurchase');
              }
              else if(data.result=='2')
              {
                window.location.replace(base_url+'index.php/AdminHome/loadProducts');
              }
              
            }
          },
          method:"POST",
          data:{"email":$('#inputEmail').val(),"password":$('#inputPassword').val()}
        });



    });
  });

</script>
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <!-- <form> -->
            <div class="form-group">
            <p class="alert alert-warning" id="warning-box" style="display:none"></p>
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <!-- <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div> -->
            <button class="btn btn-primary btn-block" href="index.html" id="loginBtn">Login</button>
          <!-- </form> -->
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo base_url() ?>index.php/Welcome/loadRegister">Register an Account</a>
            <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
