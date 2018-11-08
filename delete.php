<?php

     session_start();
        if ($_SESSION['login'] == false) {
            $url = 'index.php';
            Redirect($url, false);
        }
    $sesuser = $_SESSION['userid'];
    require 'lib/helper.php';
    include 'lib/header.php';
    $host='172.17.0.2';
    $user='root';
    $passwd='root';
    $db='todo';
    $conn= connect_db($host, $user, $passwd, $db);
    if (!$conn) {
        echo 'Error: '.mysqli_connect_error();
        exit;
    }
$id= $_GET['id'];

$sql= 'DELETE FROM task WHERE idtask = ?;';
$id= mysqli_real_escape_string($conn, $id);

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
//print_r(mysqli_stmt_error());
mysqli_close($conn);

$url = 'todo.php';
function Redirect($url, $permanent = false) {
    header('Location: ' . $url, true, $permanent ? 301 : 302);

 exit();
}
Redirect($url);
