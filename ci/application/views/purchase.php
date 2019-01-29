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
<style>


/***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

body {
    background: #f1f1f1;
}

.product-item {
    padding: 15px;
    background: #fff;
    margin-top: 20px;
    position: relative;
}
.product-item:hover {
    box-shadow: 5px 5px rgba(234, 234, 234, 0.9);
}
.product-item:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
    font-size: 0;
    line-height:0;
}
.sticker {
    position: absolute;
    top: 0;
    left: 0;
    width: 63px;
    height: 63px;
}
.sticker-new {
    background: url(http://keenthemes.com/assets/bootsnipp/new.png) no-repeat;
    left: auto;
    right: 0;
}
.pi-img-wrapper {
    position: relative;
}
.pi-img-wrapper div {
    background: rgba(0,0,0,0.3);
    position: absolute;
    left: 0;
    top: 0;
    display: none;
    width: 100%;
    height: 100%;
    text-align: center;
}
.product-item:hover>.pi-img-wrapper>div {
    display: block;
}
.pi-img-wrapper div .btn {
    padding: 3px 10px;
    color: #fff;
    border: 1px #fff solid;
    margin: -13px 5px 0;
    background: transparent;
    text-transform: uppercase;
    position: relative;
    top: 50%;
    line-height: 1.4;
    font-size: 12px;
}
.product-item .btn:hover {
    background: #e84d1c;
    border-color: #c8c8c8;
}

.product-item h3 {
    font-size: 14px;
    font-weight: 300;
    padding-bottom: 4px;
    text-transform: uppercase;
}
.product-item h3 a {
    color: #3e4d5c;
}
.product-item h3 a:hover {
    color: #E02222;
}
.pi-price {
    color: #e84d1c;
    font-size: 18px;
    float: left;
    padding-top: 1px;
}
.product-item .add2cart {
    float: right;
    color: #a8aeb3;
    border: 1px #ededed solid;
    padding: 3px 6px;
    text-transform: uppercase;
}
        .product-item .add2cart:hover {
            color: #fff;
            background: #e84d1c;
            border-color: #e84d1c;
        }

        .stroke {
   -webkit-text-stroke-width: 1px;
   -webkit-text-stroke-color: black;
}
</style>
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  </head>

  <body id="page-top">
<script>
$(document).ready(function(){

  var p;
  var id;
$('.openModal').on('click', function (e) {
   //console.log(e);
   p=parseFloat($(this).data('id')).toFixed(2);
    id=$(this).data('idd');
   var modal=$(this);
   $('#priceInModal').html('$'+ p);



 });


  
 $('#purchaseItem').click(function(){
   

$.ajax({
  url:"<?php echo base_url() ?>index.php/HomePage/purchaseProduct",
  success:function(data){
         data=JSON.parse(data);
         $('#purchaseModal').modal('hide');
         if(data.result=="1")
         {
          
          $('#warning-box').hide();
          $('#warning-box').html("thank you for your purchase");
          $('#warning-box').show("slow");
          $('#balance').html(parseFloat(data.balance).toFixed(2) );
         }
         if(data.result=="0")
         {
          $('#warning-box').hide();
          $('#warning-box').html("you do not have enough funds");
          $('#warning-box').show("slow");          
         }
         
         
       },
  method:"POST",
  data:{'price':p,'id':id}
});


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
      <div id="content-wrapper">

        <div class="container-fluid">
        <p class="alert alert-warning" id='warning-box' style="display:none"></p>
          <!-- Breadcrumbs-->
          <ol class="breadcrumb alert alert-info">
            <li class="breadcrumb-item">

              <p >Current balance <?php 
                echo '$ <span id="balance">'.  $this->db->get_where('users',array('email'=>$_SESSION['email']))->result_array()[0]['balance'].'</span>';

              ?></p>
            </li>
            
          </ol>
          <!-- Page Content -->
          <h1><?php echo "Hi, ".$_SESSION['name'] ?></h1>
          
          
          <hr>
          


<!------------------------------------->

    <div class="row">
        <?php 
          $query=$this->db->get('products');
          foreach($query->result() as $row)
          {

            $disc=0.0;
            if($row->price>=112 && $row->price<=115)
            {
              $disc=0.25/100;
            }
            if($row->price>120)
            {
              $disc=0.5/100;
            }
            if($disc!=0)
            {
              $price=$row->price-($row->price*$disc);
            }
            else{
              $price=$row->price;
            }
            //var_dump($row);
              echo '        <div class="col-md-4">
              <div class="product-item">
                <h3><a href="shop-item.html">'.$row->name.'</a></>
                  <img src="'.$row->image.'"  width="100%" height="400" />';

                  if($disc!=0)
                  {
                    echo '<div class="pi-price" ><del>$ '.$row->price.'</del></div>  ';
                    echo '<div class="pi-price" >$ '.number_format((float)$price, 2, '.', '').'</div>'  ;
                  }
                  else {
                    echo '<div class="pi-price" >$ '.$row->price.'</div>  ';
                  }
                  echo '
                  <br><br><br>
                  <p>'.$row->description.' </p> 
                  
                  
                 <button data-id="'.$price.'" data-idd="'.$row->id.'" data-toggle="modal" data-target="#purchaseModal" class="btn add2cart openModal">Purchase</button>
                 
                </div>
              </div>
          '        ;    
          }
      ?>

    </div>



<!------------------------------------->

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






    <!-- purchase Modal-->
    <div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Purchase?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          you are about to make a purchase of <b id='priceInModal'></b>
          
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" id='purchaseItem'>Purchase</button>
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

  </body>

</html>
