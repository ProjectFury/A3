<html>
    <?php
        session_start();
        if ($_SESSION['login'] == true) {
            $url = 'todo.php';
            Redirect($url, false);
        }
        
        function Redirect($url, $permanent = false) {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

         exit();
        }
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
    ?>
<div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
        <h1>Registro de nuevo usuario</h1>
        <h5>Por favor, introduce tus datos en los campos correspondientes</h5>
        <div class="mt-4 row">
            <form class="w-100" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="col-md-12">Usuario<br><input style="width: 50%;" type="text" name="username" required placeholder="Introduce tu usuario"></div>
                    <div class="col-md-12">Contraseña<br><input style="width: 50%;" class="pw" type="password" name="pw1" placeholder="Introduce tu contraseña"></div>
                    <div class="col-md-12">Vuelve a introducir tu contraseña<br><input style="width: 50%;" class="pw" type="password" required name="pw2" placeholder="Vuelve a introducr tu contraseña"></div>
                <button class="mt-1 btn btn-primary" type="submit">ENVIAR</button>
            </form>
        </div>
    </div>
        
        
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //password_hash(pass, PASSWORD_DEFAULT);
                //login: password_verify(pass, dbpass);
                $username = $_POST['username'];
                $pass1 = $_POST['pw1'];
                $pass2 = $_POST['pw2'];
                if ($pass1 == $pass2) {
                    $sql= 'INSERT INTO user (username, password) VALUES (?, ?)';
                    $username = mysqli_real_escape_string($conn, $username);
                    $pass1 = mysqli_real_escape_string($conn, password_hash($pass1, PASSWORD_DEFAULT));
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'ss', $username,$pass1);
                    mysqli_stmt_execute($stmt);
                    echo '<div style="color: green; text-align: center;">Usuario registrado correctamente.</div>';
                } else {;
                    echo '<div style="color: red; text-align: center;">Las contraseñas no coinciden.</div>';
                }
                
            }
            include 'lib/footer.php';
        ?>
    
</html>

