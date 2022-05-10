<?php
    include 'connect.php';

    if ( isset($_POST['submit']) ) {
        $kamar = $_POST['room'];

        $del = mysqli_query($conn,"DELETE FROM finalproject WHERE kamar=$kamar");

        if ($del) {
            header("Location:http://localhost/xampp/final-project/index.php");
        } else {
            echo "<script> alert('Penghapusan data gagal !') </script>";
        }
    } else {
        echo "<script> alert(' Belum melakukan penghapusan !') </script>";
    }
?>