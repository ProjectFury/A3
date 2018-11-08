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
        include 'lib/header.php';
    ?>
    <div class="w-50 mt-5 p-5 mx-auto rounded titlebox">
        <h1>Bienvenido a To-doIt</h1>
        <h5>¡Aquí podrás crear tus listas de tareas para no olvidarte nunca!</h5>
        <div class="mt-4 row">
            <div class="col-md-6"><div>¿Eres un nuevo usuario?</div><a href="register.php"><button class="btn btn-primary">¡Regístrate ahora!</button></a></div>
            <div class="col-md-6"><div>¿Ya tienes cuenta?</div><a href="login.php"><button class="btn btn-primary">Accede a tu cuenta</button></a></div>
        </div>
    </div>
        
        
        <?php
            include 'lib/footer.php';
        ?>
    
</html>


