<?php 
if (!file_exists("foto")) {
    mkdir("foto", 0777, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="logo.png">
  <title>Keanggotaan Koperasi</title>
  <style type="text/css">
  #header{
    background: #20B2AA;
    padding: 2px;
  }
  #header ul > li{
    display: inline;
    list-style-type: none;
    padding-right: 30px;
  }
  #header li a{
    color: white;
    text-decoration: none;
    padding: 5px;
  }
  #header li > a:hover{
    background: white;
    color: black;
  }
  #content{
    background: white;
    min-height: 100vh;
    padding: 10px;
  }
  #footer{
    background: #20B2AA;
    padding: 5px;
    color: white;
    text-align: center;
  }
  </style>
</head>
<body>
  <div id="header">
    <ul>
      <li style="color: white;font-family: calibri;font-size: 35px;font-weight: bold">KOPERASI</li>
      <li><a href="index.php?page=home" style="font-family: calibri;font-size: 20px">Home</a></li>
      <li><a href="index.php?page=anggota" style="font-family: calibri;font-size: 20px">Anggota</a></li>
    </ul>
  </div>
  
  <div id="content">
    <?php include "config.php";?>
  </div>
  
  <div id="footer">
    <a style="font-family: calibri; font-size: 20px; color: white">Copyright &copy; Rizky Edyatna Putra</a>
  </div>
</body>
</html>