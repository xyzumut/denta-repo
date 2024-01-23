<?php

    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    
    require_once('database.php');
    
    $myDatabase = new Database();
    
    function myResponse($status, $message, $data = null) : string {
        return json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
    }

    if( isset($_GET['operation']) ) {
        http_response_code(200);
        echo myResponse(false, 'Kitaplar Getirildi', $myDatabase->getAllBooksWithCategory());
    }
    else{
        http_response_code(404);
        echo myResponse(false, 'Bu istek tanimsiz');
    }
?>