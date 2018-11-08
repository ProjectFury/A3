<html>
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
            $taskcol = $_POST['task'];
            $sql= 'INSERT INTO task (taskcol, user_iduser) VALUES (?, ?)';
            $sesuser = mysqli_real_escape_string($conn, $sesuser);
            $taskcol = mysqli_real_escape_string($conn, $taskcol);
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'si', $taskcol,$sesuser);
            mysqli_stmt_execute($stmt);
        }
        $sql= 'SELECT * FROM task WHERE user_iduser = ?;';
                $sesuser= mysqli_real_escape_string($conn, $sesuser);

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $sesuser);
                mysqli_stmt_execute($stmt);
                //print_r(mysqli_stmt_error());
                mysqli_stmt_bind_result($stmt,$idtask,$taskcol,$user_iduser);
                while(mysqli_stmt_fetch($stmt)){
                    $rows[]=array(
                        'id' => $idtask,
                        'taskcol' => $taskcol,
                        'iduser' => $user_iduser,
                    );
                }
        ?>
    <div>Bienvenido a tu página de tareas pendientes</div>
    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
       <input type="text" name="task" />
    <input type="submit" value="Crear tarea"/>
    </form>


<?php
for ($i = 0; $i < count($rows); $i++) {
    echo '<div style="margin: 20px; width:200px; height: 200px; border: 1px solid black; display: inline-block;"><div style="height: 90%;">'. $rows[$i]['taskcol'] .'</div><div style="background-color: darkgrey; height: 10%;"><a href="delete.php?id='. $rows[$i]['id'] .'"><button style="width: 20px; height: 20px; background-color: red; color: white; font-weight: bold;"><p style="margin-top: -4px;">X</p></button></a><a href="modify.php?id='. $rows[$i]['id'] .'"><button style="width: 20px; height: 20px; background-color: orange; color: white; font-weight: bold;"><p style="margin-top: -4px;">M</p></button></a></div></div>';
}

mysqli_close($conn);


  include 'lib/footer.php';
?>
</html>

