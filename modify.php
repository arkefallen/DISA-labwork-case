<?php
    include 'connect.php';

    if ( isset($_POST['submit']) ) {
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

        $query = "SELECT * FROM finalproject";

        $queryResult = mysqli_query($conn,$query);

        if ( mysqli_num_rows($queryResult) > 0 ) {

            $id = $_POST['id'];
            $nama = $_POST['name'];
            $asal = $_POST['city'];
            $kampus = $_POST['campus'];
            $no = $_POST['phone'];
            $kamar = $_POST['room'];

            $result = mysqli_query($conn,"UPDATE finalproject SET nama='$nama',alamat='$asal',kampus='$kampus', no_hp='$no', kamar=$kamar WHERE id=$id ");

            if ( $result ) {
                echo "<script> alert('Berhasil mengubah data penghuni kos !') </script>";
                // header("Location:http://localhost/xampp/final-project/index.php");
            } else {
                echo "<script> alert('Pengubahan data gagal !') </script>";
            }
            
        } else {
            echo "<script> alert('Tidak ada data dalam database !') </script>";
        }

    } else {
        echo "<script> Anda belum memasukkan data ! </script> ";
    }
?>