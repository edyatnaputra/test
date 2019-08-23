<?php
session_start();

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
    	$nik = $_GET['nik'];
    	$name = $_FILES["file"]["name"];
		$ext = end((explode(".", $name)));
		$_SESSION["ext"] = $ext;
		$nama_file = $nik.'.'.$ext;

        move_uploaded_file($_FILES['file']['tmp_name'], '../foto/'.$nama_file);
    }

?>