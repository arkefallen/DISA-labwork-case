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
                $id_penghuni = $i;
                break;
            }
        }
    
        $result = mysqli_query($conn,$insertData);
    
    } else {
        $result = mysqli_query($conn,"INSERT INTO finalproject VALUES(1,'$nama','$asal','$kampus','$no',$kamar)");
        $id_penghuni = 1;
    }


    $url = 'http://192.168.56.45/final-project/api/penghuni.php';

    $fields = array(
        'name' => $nama,
        'city' => $asal,
        'campus' => $kampus,
        'phone' => $no,
        'room' => $kamar
    );

    $curl_connection = curl_init($url);

    //Encode the array into JSON.
    $jsonDataEncoded = json_encode($fields);

    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);

    //Tell cURL that we want to send a POST request.
    curl_setopt($curl_connection, CURLOPT_POST, true);

    //Attach our encoded JSON string to the POST fields.
    curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    //Set the content type to application/json
    curl_setopt($curl_connection, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

    //Execute the request
    $result = curl_exec($curl_connection);

    // $decoded = json_decode($result, true);

    curl_close($curl_connection);

    header("Location: http://localhost/xampp/final-project/index.php");
?>