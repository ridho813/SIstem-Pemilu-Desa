<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
   header('location: ./');
}
define('BASEPATH', dirname(__FILE__));

include('../include/connection.php');
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Dashboard ~ E-Voting Menggunakan E-KTP berbasis RFID</title>
      <link rel="stylesheet" href="../assets/css/foundation.min.css" />
      <link rel="stylesheet" href="../assets/css/dashboard.css" />
          <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

   </head>
   <body>
      <div class="container">
         <div class="row">
            <?php
            include('../include/navbar.php');
            ?>

            <div id="main" class="large-10 medium-9 columns">
               <!-- Modal -->
               <div class="reveal" id="animatedModal10" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
                  <h4 style="margin-bottom:1px">Warning</h4>
                  <hr />
                  <p style="font-size:18px">Apakah anda yakin ingin keluar dari aplikasi ?</p>
                  <div class="text-right">
                     <a href="?page=logout" class="button alert">Logout</a>
                  </div>
                  <button class="close-button" data-close aria-label="Close reveal" type="button">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <?php
               if(isset($_GET['page'])) {
                  switch ($_GET['page']) {
                     case 'user':
                        include('./user/index.php');
                        break;
                     case 'kelas':
                        include('./kelas/index.php');
                        break;
                     case 'kandidat':
                        include('./kandidat/index.php');
                        break;
                     case 'user':
                        include('./user/index.php');
                        break;
                     case 'perolehan':
                        include('./perolehan.php');
                        break;
                     case 'edit_profil':
                        include('./edit.php');
                        break;
                     case 'change_password':
                        include('./pass.php');
                        break;
                     case 'logout':
                        unset($_SESSION['id_admin']);
                        unset($_SESSION['user']);

                        header('location:./');
                        break;
                     default:
                        include('./welcome.php');
                        break;
                  }
               } else {
                  include('./welcome.php');
               }
               ?>
<br><br>

                                                 <!-- Content Row -->
                                                 <div class="row">

<!-- Jumlah Pemilih -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <?php 
                       include('../include/connection.php');

                       $pemilih= mysqli_query($con,"SELECT * FROM t_user");
                        $jumlah_pemilih = mysqli_num_rows($pemilih);
                    ?>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pemilih</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_pemilih; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumlah Kandidat -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <?php
                      include('../include/connection.php');

                       $kandidat= mysqli_query($con,"SELECT * FROM t_kandidat");
                        $jumlah_kandidat = mysqli_num_rows($kandidat);
                    ?>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kandidat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_kandidat; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-id-card fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pemilih yang sudah memilih -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                   <?php
                    include('../include/connection.php');

                     $user = mysqli_query($con,"SELECT * FROM t_user k, t_suara s where s.nis =k.id_user");
                     $userss = mysqli_num_rows($user);
                   ?>
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pemilih Yang Sudah Memilih</div>
                
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userss; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pemilih yang belum memilih -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                <?php
                    include('../include/connection.php');
                $user = mysqli_query($con,"SELECT * FROM t_user k, t_suara s where s.nis =k.id_user");
$userss = mysqli_num_rows($user);
// mengambil data barang
$data_barang = mysqli_query($con,"SELECT * FROM t_user");
// menghitung data barang
$jumlah_barang = mysqli_num_rows($data_barang);

?>
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pemilih Yang Belum Memilih</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_barang-$userss; ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
            </div>
            




     <script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/foundation.js"></script>
<script type="text/javascript" src="../assets/js/docs.js"></script>

   <script type="text/javascript" src="../assets/js/chart-bundle.js"></script>
   <script type="text/javascript" src="../assets/js/utils.js"></script>
   <script type="text/javascript" src="../assets/js/FileSaver.min.js"></script>
   <script type="text/javascript" src="../assets/js/canvas-toBlob.js"></script>
    	
    <!-- Scripts -->
    <script src="../js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="../js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="../js/scripts.js"></script> <!-- Custom scripts -->


<script type="text/javascript">
   // slideToggle()
   $(document).ready(function() {
      $(".dropdown-toggle").click(function() {
         $(this).parent().find(".dropdown-menu").slideToggle();
      });
      $("#menu-toggle").click(function() {
         $(this).parent().find(".menu").slideToggle();
      });
   });

   $("#save-img").click(function() {
      $('#canvas').get(0).toBlob(function(blob) {
         saveAs(blob, 'chart.png');
      });
   });
 

      function tampil() {
         $.ajax({
            url: 'ajax.php',
            method: "GET",
            success: function(data) {
               $('#data').html(data);
            }
         });
      }

      $(document).ready(function() {
         $('#periode').change(function() {
            var periode = $('#periode').val();

            $.ajax({
               url: "ajax.php",
               method: "POST",
               data: {
                  periode: periode
               },
               success: function(data) {
                  $('#data').html(data);
               }
            });
         });
      });

      window.onload = function() {
         tampil();
      };

   <?php
 
      $thn = date('Y');
      $dpn = date('Y') + 1;
      $periode = $thn . '/' . $dpn;
      $kan = $con->prepare("SELECT k.id_kandidat AS id_kandidat, nama_calon, foto, visi, misi, COUNT(su.id_kandidat) AS suara, k.periode AS periode FROM t_kandidat k LEFT JOIN t_suara su ON(k.id_kandidat = su.id_kandidat) WHERE k.periode = ? GROUP BY k.id_kandidat") or die($con->error);
      $kan->bind_param('s', $periode);
      $kan->execute();
      $kan->store_result();
      $numb = $kan->num_rows();
      $label = '';
      $data = '';
      for ($i = 1; $i <= $numb; $i++) {
         $kan->bind_result($id, $nama, $foto, $visi, $misi, $suara, $kandidat);
         $kan->fetch();
         $label .= "'" . $nama . "',";
         $data .= $suara . ',';
      }
      $labels = trim($label, ',');
      $datas  = trim($data, ',');
      ?>
      
      var chartData = {
         labels: [
            <?php
            echo $labels;
            ?>
         ],
         datasets: [{
            type: 'bar',
            label: 'Jumlah Suara',
            borderColor: window.chartColors.green,
            backgroundColor: [
               window.chartColors.blue,
               window.chartColors.red,
               window.chartColors.green,
            ],
            borderWidth: 2,
            fill: false,
            data: [
               <?php
               echo $datas;
               ?>
            ]
         }],
      };
      window.onload = function() {
         var ctx = document.getElementById("canvas").getContext("2d");
         window.myMixedChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
               responsive: true,
               title: {
                  display: true,
                  text: 'Perolehan Suara',
                  fontSize: 30
               },
               legend: {
                  labels: {
                     fontSize: 10
                  }
               },
               scales: {
                  xAxes: [{
                     ticks: {
                        fontSize: 15
                     }
                  }],
                  yAxes: [{
                     ticks: {
                        fontSize: 15,
                        min: 0
                     }
                  }]
               }
            }
         });
      };
   <?php

?>

</script>
   </body>
</html>
