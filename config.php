<?php
$page = (isset($_GET['page']))? $_GET['page'] : '';
switch($page){
  case 'home':
  include "halaman/home.php";
  break;
  
  case 'anggota':
  include "halaman/anggota.php";
  break;
  
  default:
  include "halaman/home.php";
}
?>