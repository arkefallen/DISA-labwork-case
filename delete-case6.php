<?php
    include 'connect.php';

    if ( isset($_POST['submit']) ) {
        $kamar = $_POST['room'];

        $del = mysqli_query($conn,"DELETE FROM finalproject WHERE kamar=$kamar");

        if ( $del ) {

            $url = 'http://192.168.56.45/final-project/api/penghuni.php?room='.$kamar.'';

            $fields = array(
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

            header("Location:http://localhost/xampp/final-project/index.php");
        } else {
            echo "<script> alert('Penghapusan data gagal !') </script>";
        }
    } else {
        echo "<script> alert(' Belum melakukan penghapusan !') </script>";
    }
?>