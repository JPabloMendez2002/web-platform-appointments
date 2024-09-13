<?php
require('./superadmin/claseSUADMIN.php');

if ($_POST['accion'] == 'entrarlogin') {

    $usuario = $_POST['usuario'];
    $pass = md5($_POST['contrasena']);

    if (!preg_match("/^[a-zA-Z0-9_@.]*$/", $usuario)) {
?>
        <hr>
        <div class="toast show text-center">
            <div class="card-header alert-secondary" style="text-align: center;">
                <strong class="me-auto">Bienestar Sistema informa <i class="fa-duotone fa-circle-info"></i></strong>
            </div>
            <div class="toast-body alert-danger">
                <center>
                    <h6>El usuario no puede contener caracteres especiales <i class="fa-duotone fa-triangle-exclamation"></i></h6>
                </center>
            </div>
        </div>
        <?php
    } else {

        $loginSUAD = $ObjSUADM->loginSUAD($usuario, $pass);
        if ($loginSUAD) {
            $_SESSION['suadmin'] = $usuario;

            foreach ($loginSUAD as $datos => $row) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['user'];
                $_SESSION['name'] = $row['name'];
            }

        ?>
            <script>
                window.location.href = './superadmin/inicio.php';
            </script>
        <?php
        } else {

            $loginAD = $ObjSUADM->loginAD($usuario, $pass);
            if ($loginAD) {
                $_SESSION['admin'] = $usuario;

                foreach ($loginAD as $datos => $row) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $row['user'];
                    $_SESSION['name'] = $row['name'];
                }

            ?>
                <script>
                    window.location.href = './admin/inicio.php';
                </script>
            <?php
            } else {
                $loginUS = $ObjSUADM->loginUS($usuario, $pass);
                if ($loginUS) {
                    $_SESSION['user'] = $usuario;

                    foreach ($loginUS as $datos => $row) {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['user'] = $row['user'];
                        $_SESSION['name'] = $row['name'];
                    }

                ?>
                    <script>
                        window.location.href = './user/inicio.php';
                    </script>
                <?php
                } else {
                    ?>
                    <div class="toast show">
                        <div class="card-header alert-secondary" style="text-align: center;">
                            <strong class="me-auto">Bienestar Sistema informa <i class="fa-duotone fa-circle-info"></i></strong>
                        </div>
                        <div class="toast-body alert-danger">
                            <center>
                                <h6>El usuario o la contraseña no coinciden <i class="fa-duotone fa-triangle-exclamation"></i></h6>
                            </center>
                        </div>
                    </div>
                <?php
                }
            }
        }
    }
}

?>