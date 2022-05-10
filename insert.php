<?php
    include 'connect.php';

    if ( !isset($_POST['name']) ) {
        echo "<script> alert('Silahkan masukkan nama dengan benar !') </script>";
    } else if ( !isset($_POST['city']) ){
        echo "<script> alert('Silahkan masukkan kota asal dengan benar !') </script>";
    } else if ( !isset($_POST['campus']) ) {
        echo "<script> alert('Silahkan masukkan nama kampus penghuni dengan benar !') </script>";
    } else if ( !isset($_POST['phone']) ) {
        echo "<script> alert('Silahkan masukkan nomor HP penghuni dengan benar !') </script>";
    } else if ( !isset($_POST['room'])){
        echo "<script> alert('Silahkan pilih kamar dengan benar !') </script>";
    }

    $nama = $_POST['name'];
    $asal = $_POST['city'];
    $kampus = $_POST['campus'];
    $no = $_POST['phone'];
    $kamar = $_POST['room'];

    $query = "SELECT * FROM finalproject";

    $queryResult = mysqli_query($conn,$query);

    // Ambil semua ID dari db dan simpen ke array
    if ( mysqli_num_rows($queryResult) > 0 ) {
        
        $id = array();
        foreach ($queryResult as $value) {
            array_push($id,$value['id']);
        }
    
        // Cek ID yang sudah ada dalam DB dan pakai ID sesuai urutan agar tidak terduplikasi lalu insert data menggunakan ID yg sudah sesuai urutan
        for( $i = 1; $i<=20; $i++ ) {
            if ( in_array($i,$id) ) continue;
            else {
                $insertData = "INSERT INTO finalproject VALUES($i,'$nama','$asal','$kampus','$no',$kamar)";
                break;
            }
        }
    
        $result = mysqli_query($conn,$insertData);
    
        
    } else {
        $result = mysqli_query($conn,"INSERT INTO finalproject VALUES(1,'$nama','$asal','$kampus','$no',$kamar)");
    }
    
    if ( $result ) {
        echo "<script> alert('Berhasil menambah penghuni kos !') </script>";
    } else {
        echo "<script> alert('Penambahan data gagal !') </script>";
    }
    header("Location:http://localhost/xampp/final-project/index.php");
   
?>