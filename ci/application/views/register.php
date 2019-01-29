<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

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
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
 //   alert("You have entered an invalid email address!")
    return (false)
}

  $(document).ready(function(){
    $('#registerBtn').click(function(){
      
      if($('#inputPassword').val()!=$('#confirmPassword').val())
      {
        $('#warning-box').html('passwords do not match');
        $('#warning-box').hide();
        $('#warning-box').show('slow');
        return;
      }
      else if( $('#confirmPassword').val().length<1 || $('#inputPassword').val().length<1)
      {
        $('#warning-box').html('passwords cannot be blank');
        $('#warning-box').hide();
        $('#warning-box').show('slow');
        return;

      }

      else if(! ValidateEmail($('#inputEmail').val()))
      {
        $('#warning-box').html('you have entered an invalid email');
        $('#warning-box').hide();
        $('#warning-box').show('slow');
        return;

      }

      $('#warning-box').hide();
        $.ajax({
          url:"<?php echo base_url() ?>index.php/Welcome/registerUser",
          success:function(data){
            //alert(data);         
            data=JSON.parse(data);
            if(data.result=="1")
            {
              $('#warning-box').hide();
              $('#warning-box').html('thank you for registering please login');
              $('#warning-box').show('slow');
            }
            else{
              $('#warning-box').hide();
              $('#warning-box').html('failed to register user already exists');
              $('#warning-box').show('slow');

            }
          },
          method:"POST",
          data:{"name":$('#firstName').val(),"lastname":$('#lastName').val(),"email":$('#inputEmail').val(),"password":$('#inputPassword').val(),"cpassword":$('#confirmPassword').val()}
        });
    })

  });
</script>



    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <p class="alert alert-warning" style='display:none' id='warning-box'>passwords are not equal</p>
        <div class="card-body">
          <!-- <form> -->
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                    <label for="firstName">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required">
                    <label for="lastName">Last name</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-block"   id="registerBtn">Register</button>
          <!-- </form> -->
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo base_url() ?>index.php/Welcome/index">Login Page</a>
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
