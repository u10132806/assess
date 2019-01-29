<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Blank Page</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/jquery.dm-uploader.min.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/ui-demo.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.dm-uploader.min.js"></script>
  </head>

  <body id="page-top">
<script>

  $(document).ready(function(){

var imageLocation="";
    $("#drag-and-drop-zone").dmUploader({
        url: "uploadFile",
        allowedTypes:"image/*",
        //... More settings here...
        
        onInit: function(){
          console.log('Callback: Plugin initialized');
        },
        multiple: false,
        onUploadSuccess: function(id, data){
      var response = JSON.stringify(data);
      this.find('input[type="text"]').val(response);
          $('#fileName').val(data);
          $("#imageuploaded").attr("src",JSON.parse(data).location );
          $('#nofiles').hide();
          imageLocation=JSON.parse(data).location ;
    },        // ... More callbacks
      });



    $.ajax({
          url:"<?php echo base_url() ?>index.php/AdminHome/generateProductCode",
          success:function(data){
            data=JSON.parse(data);
            $('#code').val(data.result);
          },
          method:"POST",
          
        });
       // alert(regex.test(numStr));
        $('#addProduct').click(function(){
          var regex  = /^[0-9]+(\.[0-9]{1,2})?$/gm;
      var numStr = $('#price').val();

            if(imageLocation=="")
            {
              $('#warning-box').hide();
              $('#warning-box').html('Please upload an image');
              $('#warning-box').show('slow');
            }
            else if($('#name').val().replace(/^\s+/, '').replace(/\s+$/, '')==='')
            {
              $('#warning-box').hide();
              $('#warning-box').html('Please enter a product name');
              $('#warning-box').show('slow');
            }
            else if (!regex.test(numStr)){
                $('#warning-box').hide();
                $('#warning-box').html('Please enter a valid price');
                $('#warning-box').show('slow');            
            }
            else if($('#desciption').val().replace(/^\s+/, '').replace(/\s+$/, '')==='')
            {
                $('#warning-box').hide();
                $('#warning-box').html('Please enter a product description');
                $('#warning-box').show('slow');            

            }
            else{
              $.ajax({
          url:"<?php echo base_url() ?>index.php/AdminHome/insertProduct",
          success:function(data){
           data=JSON.parse(data);
           if(data.result=="1")
           {
                $('#warning-box').hide();
                $('#warning-box').html('Product added');
                $('#warning-box').show('slow');            
           }
           else {
                $('#warning-box').hide();
                $('#warning-box').html('could not add product');
                $('#warning-box').show('slow');            

           }
          },
          data:{'image':imageLocation,'name':$('#name').val(),'price':$('#price').val(),'description':$('#desciption').val(),'code':$('#code').val()},
          method:"POST",
          
        });

            }

            

        });

  });
</script>
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Start Bootstrap</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Navbar -->
      <!-- <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul> -->

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php 
      echo '<ul class="sidebar navbar-nav">';
      foreach($data as $d)
      {
        echo '        <li class="nav-item">
                <a class="nav-link" href="'.$d['link'].'">
                  <i class="'.$d['icon'].'"></i>
                  <span>'.$d['menu_name'].'</span>
                </a>
              </li>
      ';
      }
      echo "</ul>"
      ?>
      
<!----------------------make dynamic----------------------->
      <!-- <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
        </li>
      </ul> -->
<!----------------------make dynamic----------------------->
<hr>
      <div id="content-wrapper">

        <div class="container-fluid">



          <!-- Page Content -->
            <!-- <div class="input-group-append">
              <span class="input-group-text">.00</span>
            </div> -->

          <p class='alert alert-warning' id='warning-box' style="display:none"></p>

            <p>upload a picture of the product</p>
            <main role="main" class="container">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          
          <!-- Our markup, the important part here! -->
          <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

            <div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
                <input type="file" title='Click to add Files' />
            </div>
          </div><!-- /uploader -->

        </div>
        <div class="col-md-6 col-sm-12">
          <div class="card h-100">
            <div class="card-header">
              <img id="imageuploaded" width="400" height="400">
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li id="nofiles" class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
        </div>
      </div><!-- /file list -->




    </main> <!-- /container -->


          
          <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" id="name">
          </div>

          <label for="price">Product Price:</label><br>
          <div class="input-group mb-3">
          
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input type="text" id="price" class="form-control" aria-label="Amount (to the nearest dollar)">
          </div>

          <div class="form-group">
            <label for="desciption">Description:</label>
            <textarea class="form-control" rows="5" id="desciption"></textarea>
          </div> 

          <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" class="form-control" disabled rows="5" id="code">
          </div> 


          <button class="btn btn-info" id="addProduct">Add product</button>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/js/sb-admin.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/demo-config.js"></script>
    <script src="<?php echo base_url() ?>assets/js/demo-ui.js"></script>
    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

  </body>

</html>
