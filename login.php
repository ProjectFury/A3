<html>
    <?php
        session_start();
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
        $url = 'todo.php';
        function Redirect($url, $permanent = false) {
            header('Location: ' . $url, true, $permanent ? 301 : 302);

         exit();
        }
        if ($_SESSION['login'] == true) {
        $url = 'todo.php';
        Redirect($url, false);
    }
    ?>
<div class="w-50 mt-5 p-4 mx-auto rounded titlebox">
        <h1>Registro de nuevo usuario</h1>
        <h5>Por favor, introduce tus datos en los campos correspondientes</h5>
        <div class="mt-4 row">
            <form class="w-100" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="mt-1 row">
                    <div class="col-md-6">Usuario<br><input type="text" name="username" placeholder="Introduce tu usuario"></div>
                    <div class="col-md-6">Contraseña<br><input type="password" name="pw1" placeholder="Introduce tu contraseña"></div>
                </div>
                <button class="mt-1 btn btn-primary" type="submit">Acceder</button>
            </form>
        </div>
    </div>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
                //password_hash(pass, PASSWORD_DEFAULT);
                //login: password_verify(pass, dbpass);
                $username = $_POST['username'];
                $pass1 = $_POST['pw1'];
                $sql= 'SELECT * FROM user WHERE username = ?;';
                $username = mysqli_real_escape_string($conn, $username);

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                //print_r(mysqli_stmt_error());
                mysqli_stmt_bind_result($stmt,$id,$username,$password);
                while(mysqli_stmt_fetch($stmt)){
                    $rows[]=array(
                        'id' => $id,
                        'Username' => $username,
                        'Password' => $password,
                    );
                }
                if (count($rows) == 0) {
                    echo '<div style="color: red; text-align: center;">No se ha encontrado ese usuario.</div>';
                } else {
                    if (password_verify($pass1, $rows[0]["Password"])) {
                        $_SESSION['login']= true;
                        $_SESSION['userid']= $rows[0]['id'];
                        $_SESSION['username']= $rows[0]['Username'];
                        Redirect($url,false);
                        } else {
                            echo '<div style="color: red; text-align: center;">Contraseña incorrecta.</div>';
                        }
                }
                
                }
                include 'lib/footer.php';
        ?>
</html>
