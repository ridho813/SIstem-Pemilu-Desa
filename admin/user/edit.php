<?php
if(!isset($_SESSION['id_admin'])) {
   header('location: ../');
}

$id   = strip_tags(mysqli_real_escape_string($con, $_GET['id']));

$sql  = $con->prepare("SELECT * FROM t_user WHERE id_user = ?") or die($con->error);
$sql->bind_param('s', $id);
$sql->execute();
$sql->store_result();
$sql->bind_result($id_user, $fullname,$kls, $jk, $pemilih);
$sql->fetch();

?>
<h3>Update Data Masyarakat</h3>
<hr />
<div class="row">
   <div class="medium-6">
      <form action="./user/update.php" method="post">
         <div>
            <label>No.KTP</label>
            <input class="wide text input" type="number" name="nis" placeholder="Identitas Pemilih" type="number" readonly value="<?php echo $id_user; ?>"/>
         </div>
         <div>
            <label>Nama Sesuai KTP</label>
            <input class="wide password input" name="nama" type="text" placeholder="Nama Sesuai KTP" value="<?php echo $fullname; ?>"/>
         </div>
         <div>
            <label class="inline" for="text2">Jenis Kelamin</label>

            <input type="radio" name="jk" value="L" id="L" <?php if($jk == 'L') { echo 'checked'; } ?>><label for="L">Laki - laki</label>

            <input type="radio" name="jk" value="P" id="P" <?php if($jk == 'P') { echo 'checked'; } ?>><label for="P">Perempuan</label>
         </div>
         <div>
         </div>
         <div class="picker">
            <label class="inline" for="text2">Pemilih</label>
            <select name="pemilih" required="Pemilih">
               <option value="Y" <?php if($pemilih == 'Y') { echo 'selected';} ?>>Aktif</option>
               <option value="N" <?php if($pemilih == 'N') { echo 'selected';} ?>>Tidak</option>
            </select>
         </div>
         <br>
         <input type="submit" name="update" value="Update User" class="button"/>
         <button onclick="window.history.go(-1)" class="button alert">Kembali</button>
       <button  class="button primary" ><a href="fingeprint.php">   Fingerprint </a></button> 
      </form>
   </div>
</div>
