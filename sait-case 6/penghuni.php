<?php
    require_once "method.php";
    $penghuni = new PenghuniKos();
    $request_method=$_SERVER["REQUEST_METHOD"];
    switch ($request_method) {
        case 'GET':
            if ( !empty($_GET['id']) ) {
                $id = intval($_GET['id']);
                $penghuni->get_penghuni($id);
            } else {
                $penghuni->get_all_penghuni();
            }
            break;
        case 'POST':
            if ( !empty($_GET['id']) ) {
                $id = intval($_GET['id']);
                $penghuni->update_penghuni($id);
            } elseif (!empty($_GET['room'])) {
                $kamar = intval($_GET['room']);
                $penghuni->delete_penghuni($kamar);
            } else {
                $penghuni->insert_penghuni();
            }
            break;
        default:
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }
?>