<?php
    require_once 'connect.php';

    // if ( function_exists($_GET['function'])) {
    //     $_GET['function']();
    // }

    function get_penghuni()
    {
        global $conn;
        $query = $conn->query("SELECT * FROM finalproject");

        // Ambil hasil query dan simpan per record jadi array
        while( $row=mysqli_fetch_object($query) )
        {
            $data[]=$row;
        }

        // Bikin API nya
        if ($data) {
            $response = array(
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 1,
                'message' => 'Data not found'
            );
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function get_penghuni_id()
    {
        global $conn;
        if ( !empty($_GET['id'])) {
            $id = $_GET['id'];
        }

        $query = "SELECT * FROM finalproject WHERE id = $id";
        $result = $conn->query($query);

        while( $row = mysqli_fetch_object($result) ) {
            $data[] = $row;
        }

        if ($data) {
            $response = array(
                'status' => 1,
                'message' => 'Success',
                'data' => $data
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Data not found'
            );
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function insert_penghuni()
    {
        global $conn;
        $check = array(
            'id' => '',
            'name' => '',
            'city' => '',
            'campus' => '',
            'phone' => '',
            'room' => ''
        );
        
        $check_match = count(array_intersect_key($_POST, $check));

        if ($check_match == count($check)) {
            
            $nama = $_POST['name'];
            $asal = $_POST['city'];
            $kampus = $_POST['campus'];
            $no = $_POST['phone'];
            $kamar = $_POST['room'];

            $query = "SELECT * FROM finalproject";
            $queryResult = mysqli_query($conn,$query);

            $id = array();
            foreach ($queryResult as $value) {
                array_push($id,$value['id']);
            }

            for( $i = 1; $i<=20; $i++ ) {
                if ( in_array($i,$id) ) continue;
                else {
                    $insertData = "INSERT INTO finalproject VALUES($i,'$nama','$asal','$kampus','$no', $kamar)";
                    break;
                }
            }

            $result = mysqli_query($conn, $insertData);
            
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Insert Success'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Insert Failed'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Wrong parameter'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>