<?php
if (isset($_POST['add_kelas'])) {

   $id      = $_POST['id'];
   $kelas   = $_POST['kelas'];

   if ($id == null || $kelas == null) {

      echo '<script type="text/javascript">alert("Semua form harus terisi");window.history.go(-1);</script>';

   } else {

      $sql = $con->prepare("INSERT INTO t_kelas(id_kelas, nama_kelas) VALUES ( ?, ?)");
      $sql->bind_param('ss', $id, $kelas);
      $sql->execute();

      header('location:?page=kelas');
   }
}

if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

$id = mysqli_query($con, "SELECT id_kelas FROM t_kelas ORDER BY id_kelas DESC LIMIT 1");

if (mysqli_num_rows($id) > 0) {
   $key        = mysqli_fetch_array($id);
   $get        = (intval(substr($key['id_kelas'], 1))) + 1;
   $id_kelas   = "K".sprintf("%02d", $get);
} else {
   $id_kelas = 'K01';
}

?>
<h3>Tambah Data RT/RW</h3>
<hr />
<div class="row">
   <div class="medium-6 columns">
      <form action="" method="post">
         <label class="inline">Id RT/RW</label>
         <input class="wide text input" type="text" name="id" readonly value="<?php echo $id_kelas; ?>" />
         <label class="inline" for="text2">RT/RW</label>
         <input class="wide password input" name="kelas" type="text" placeholder="RT/RW" />
         <input type="submit" name="add_kelas" value="Tambah Kelas" class="button"/>
         <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
      </form>
   </div>
</div>
