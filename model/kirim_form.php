<?php 
session_start();

$connect = mysqli_connect("localhost", "root", "", "koprasi");
  if (!$connect) {
    die('Connection failed ' . mysqli_error($connect));
  }
  if (isset($_POST['save'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tgllahir = $_POST['tgl'];
    $kota = $_POST['kota'];
    $alamat = $_POST['alamat'];
    $file = $_POST['foto'];
    $name_file= $nik.'.'.$_SESSION["ext"];

    $sql = "INSERT INTO `t_anggota` (`nik`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `foto`, `id_kota`, `alamat`) VALUES ('{$nik}', '{$nama}', '{$jenis_kelamin}', '{$tgllahir}', '{$name_file}', '{$kota}', '{$alamat}')";
    if (mysqli_query($connect, $sql)) {
          echo "Tambah Data Berhasil";
    }else{
      if (!empty($file)) {
        $sql = "UPDATE `t_anggota` SET `nik` = '{$nik}', `nama` = '{$nama}', `jenis_kelamin` = '{$jenis_kelamin}', `tanggal_lahir` = '{$tgllahir}', `foto` = '{$name_file}', `id_kota` = '{$kota}', `alamat` = '{$alamat}' WHERE `t_anggota`.`nik` = '{$nik}'";
        mysqli_query($connect, $sql);
        echo "Update Dengan Foto berhasil";
      }else{
        $sql = "UPDATE `t_anggota` SET `nik` = '{$nik}', `nama` = '{$nama}', `jenis_kelamin` = '{$jenis_kelamin}', `tanggal_lahir` = '{$tgllahir}', `id_kota` = '{$kota}', `alamat` = '{$alamat}' WHERE `t_anggota`.`nik` = '{$nik}'";
          mysqli_query($connect, $sql);
          echo "Update Tanpa Foto";
      }
    }
    exit();
  }

  if (isset($_POST['delete'])) {
  	$id_anggota = $_POST['id_anggota'];
  	$sql = "DELETE FROM t_anggota WHERE id_anggota=".$id_anggota;
    if (mysqli_query($connect, $sql)) {
      echo true;
    }else {
      echo false;
    }
  	exit();
  }


  if (isset($_POST['edit'])) {
    $id_anggota = $_POST['id_anggota'];
    $sql = "SELECT * FROM t_anggota WHERE id_anggota=".$id_anggota;
    $data = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($data); 
    $data = array(
      'nik' => $row['id_anggota'],
      'nama' => $row['nama'],
      'jenis_kelamin' => $row['tanggal_lahir'],
      'foto' => $row['id_kota'],
      'alamat' => $row['alamat']
    );

    $data = $row['id_anggota'].','.$row['nama'].','.$row['tanggal_lahir'].','.$row['id_kota'].','.$row['alamat'].','.$row['nik'].','.$row['foto'].','.$row['jenis_kelamin'];
    echo $data;

}

?>