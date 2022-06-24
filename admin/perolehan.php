<div class="text-right">
   <button id="save-img" class="button  no-print">Simpan Grafik</button>
   <button class="button  no-print" onclick="window.print()">Cetak</button>
</div>
<div style="font-size:18px;">
   <canvas id="canvas"></canvas>
</div>
<?php

// menghubungkan dengan koneksi database
include('../include/connection.php');
// menghitung suara
$user = mysqli_query($con,"SELECT * FROM t_user k, t_suara s where s.nis =k.id_user");
$userss = mysqli_num_rows($user);
// mengambil data barang
$data_barang = mysqli_query($con,"SELECT * FROM t_user");
// menghitung data barang
$jumlah_barang = mysqli_num_rows($data_barang);



// menghitung perolehan suara
if (isset($_GET['page']) && $_GET['page'] == 'perolehan') {
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
      $label .= " " . $nama . " = " .$suara. "," ;
     // $data .= $nis . ',';

   }
   $labels = trim($label, '');
  // $data = trim($data, '');

   
 
}
//$data=$jumlah_barang- $jumlah_barang;
?>
<br>
<!-- menampilkan data jumlah -->

<p>Jumlah Perhitungan Suara : <b><?php echo $label ; ?></b></p>