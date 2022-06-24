<?php


    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "vot";

    $con = mysqli_connect($server, $user, $pass, $database);

    if (!$con) {
        die("<script>alert('Connection Failed.')</script>");
    }

//      //query tabel produk
//  $sql="SELECT * FROM t_suara";
//  $query=mysqli_query($con, $sql) or die(mysqli_error($con));

//  $array=array();
//  while($data=mysqli_fetch_assoc($query)) $array[]=$data; 

//  //mengubah data array menjadi format json
//  echo json_encode($array);
?>
