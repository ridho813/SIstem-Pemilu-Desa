<?php
include('../include/connection.php');
$IP="192.168.64.2"; // ip sesuai mesin finger/ respberry
$Key="0"; //keynya finger / resp
if($IP=="") $IP="192.168.64.2";
if($Key=="") $Key="0";

//port 80 conection
    $Connect = fsockopen($IP, "80", $errno, $errstr, 1);
    if($Connect){
        $soap_request="<GetAttLog>
                            <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
                            <Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
                        </GetAttLog>";
     
     

        $newLine="\r\n";
        fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
        fputs($Connect, "Content-Type: text/xml".$newLine);

 

        fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
        fputs($Connect, $soap_request.$newLine);
        $buffer="";
        while($Response=fgets($Connect, 1024)){
            $buffer=$buffer.$Response;
        }
    }else echo "Koneksi Gagal";
 
 
    $buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
    $buffer=explode("\r\n",$buffer);
    for($a=0;$a<count($buffer);$a++){
        $data=Parse_Data($buffer[$a],"<Row>","</Row>");
     
        $id_user=Parse_Data($data,"<Nomor KTP>","</Nomor>");
        $id_kelas=Parse_Data($data,"<Kelas>","</Kelas>");
        $jk=Parse_Data($data,"<Jenis Kelamin>","</Jenis>");
        $pemilih=Parse_Data($data,"<Pemilih>","</Pemilih>");
       // $jk=Parse_Data($data,"<Status>","</Status>");

 //masuk ke database   $sql = mysqli_query($con, "SELECT * FROM t_user JOIN t_kelas ON t_user.id_kelas = t_kelas.id_kelas LIMIT $start,5");
 include('../include/connection.php');
 $cekdulu= mysqli_query($con, "SELECT * from t_user where id_user='$id_user', id_kelas='$id_kelas' jk='$jk' , pemilih='$pemilih'");
  //$prosescek= mysqli_query($cekdulu);
  if (mysqli_num_rows($cekdulu) > 0) {//proses mengingatkan data sudah ada
  echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
  }
  else { //proses menambahkan data, tambahkan sesuai dengan yang kalian gunakan
   $sql = "INSERT INTO t_user(id_user, fullname, id_kelas, jk) values ('$id_user','$id_kelas','$jk','$pemilih')";
   mysqli_query($sql) or exit(mysqli_error());
  }
  ini_set('max_execution_time', 300);
     
    }
echo "<script>alert('Sudah Selesai'); </script>";

function Parse_Data ($data,$p1,$p2) {
  $data = " ".$data;
  $hasil = "";
  $awal = strpos($data,$p1);
  if ($awal != "") {
    $akhir = strpos(strstr($data,$p1),$p2);
    if ($akhir != ""){
      $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
    }
  }
  return $hasil; 
}
?>