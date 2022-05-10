<?php
    require_once "connect.php";
    class PenghuniKos
    {
        public function get_all_penghuni() 
        {
            global $conn;
            $query = "SELECT * FROM finalproject";
            $result=$conn->query($query);
            while($row=mysqli_fetch_object($result))
            {
                $data[]=$row;
            }

            if ($data) {
                $response=array(
                    'status' => 1,
                    'message' =>'Success',
                    'data' => $data
                );
            } else {
                $response=array(
                    'status' => 0,
                    'message' =>'Data not found'
                );
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function get_penghuni($id) 
        {
            global $conn;

            $query = "SELECT * FROM finalproject WHERE id = $id";
            $result = $conn->query($query);

            while( $row = mysqli_fetch_object($result) ) {
                $data[] = $row;
            }

            if ( $data ) {
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
                        header("Location: http://localhost/xampp/final-project/index.php");
        }

        public function insert_penghuni()
        {
            global $conn;

            if ( !empty($_POST['name']) ) {
                $dataPOST = $_POST;
            } else {
                $dataPOST = json_decode(file_get_contents("php://input"), true );
            }
            
            $check = array(
                'name' => '',
                'city' => '',
                'campus' => '',
                'phone' => '',
                'room' => ''
            );
            
            $check_match = count(array_intersect_key($dataPOST, $check));
    
            if ($check_match == count($check)) {
                
                $nama = $dataPOST['name'];
                $asal = $dataPOST['city'];
                $kampus = $dataPOST['campus'];
                $no = $dataPOST['phone'];
                $kamar = $dataPOST['room'];
    
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
            header("Location: http://localhost/xampp/final-project/index.php");
        }

        public function update_penghuni($id)
        {
            global $conn;

            if ( !empty($_POST['id']) ) {
                $dataPOST = $_POST;
            } else {
                $dataPOST = json_decode(file_get_contents("php://input"), true);
            }

            $check = array(
                'id' => '',
                'name' => '',
                'city' => '',
                'campus' => '',
                'phone' => '',
                'room' => ''
            );
            
            $check_match = count(array_intersect_key($dataPOST, $check));
    
            if ($check_match == count($check)) {
                
                $nama = $dataPOST['name'];
                $asal = $dataPOST['city'];
                $kampus = $dataPOST['campus'];
                $no = $dataPOST['phone'];
                $kamar = $dataPOST['room'];
    
                $result = mysqli_query($conn,"UPDATE finalproject SET nama='$nama', alamat='$asal', kampus='$kampus', no_hp='$no', kamar=$kamar WHERE id=$id ");
                
                if ($result) {
                    $response = array(
                        'status' => 1,
                        'message' => 'Update Success'
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => 'Update Failed'
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
            header("Location: http://localhost/xampp/final-project/index.php");
        }

        public function delete_penghuni($kamar) 
        {
            global $conn;

            $result = mysqli_query($conn,"DELETE FROM finalproject WHERE kamar=$kamar");
            
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Delete Success'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Delete Failed'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            header("Location: http://localhost/xampp/final-project/index.php");
        }
    }
?>