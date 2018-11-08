<?php
session_start();
session_destroy();
    $url = 'index.php';
    
    function Redirect($url, $permanent = false) {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    } 
        redirect($url,false);
?>
