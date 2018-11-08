<?php

   session_start();
        if ($_SESSION['login'] == false) {
            $url = 'index.php';
            Redirect($url, false);
        }
        function Redirect($url, $permanent = false) {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

         exit();
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
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql='UPDATE task SET taskcol = ? WHERE idtask = ? AND user_iduser = ?;';
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $taskcol = mysqli_real_escape_string($conn,$_POST['task']);
        $sesuser= mysqli_real_escape_string($conn, $sesuser);
        $stmt=mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,'sii',$taskcol, $id, $sesuser);
        mysqli_stmt_execute($stmt);
        
        //mysqli_close($conn);

        $url = 'todo.php';
        Redirect($url);
   }   
    
    
    $id= $_GET['id'];
?>

    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ;?>">
       <input type="text" name="task" />
       <input type="hidden" value="<?= $id; ?>" name="id" /> 
    <input type="submit" value="Crear tarea"/>
    </form>
<?php
include 'lib/footer.php';
?>