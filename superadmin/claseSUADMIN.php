<?php

session_start();
date_default_timezone_set("America/Costa_Rica");

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SUADM
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "citas";
    private $conn;

    // private $server = "localhost";
    // private $username = "u159637489_root2";
    // private $password = "=?tSRdc+K9";
    // private $db = "u159637489_citas";
    // private $conn;

    function __construct()
    {
        try {

            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (Exception $e) {
            echo "connection failed" . $e->getMessage();
        }
    }

    /*-----------------------------------------------GETS--------------------------------------------------*/

    function getConexion()
    {
        return $this->conn;
    }

    /*-----------------------------------------------Fin Gets-----------------------------------------------*/



    /*-----------------------------------------------Perfil--------------------------------------------------*/

    function actualizarPerfilSUADM(string $idADM, string $nombre, string $telefono, string $usuario, string $correo)
    {
        $query = "UPDATE `usuarios` SET `name`='$nombre', `phone`='$telefono', `user`='$usuario', `mail` ='$correo' WHERE id='$idADM'";
        if ($sql = $this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function actualizaContraSUADM(string $idADM, string $contrasena)
    {
        $query = "UPDATE `usuarios` SET `password`='$contrasena' WHERE id='$idADM'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('codigo' => 1));
        } else {
            echo json_encode(array('codigo' => 2));
        }
    }

    function actualizaContraUsers(string $id, string $contrasena)
    {
        $query = "UPDATE `usuarios` SET `password`='$contrasena' WHERE id='$id'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('codigo' => 1));
        } else {
            echo json_encode(array('codigo' => 2));
        }
    }

    /*-----------------------------------------------Fin Perfil-------------------------------------------------*/



    /*---------------------------------------------Logins--------------------------------------------------*/

    function loginSUAD()
    {
        $datos = func_get_args();
        $data = null;

        $query = "SELECT * FROM `usuarios` where `user`='$datos[0]' and `password`='$datos[1]' and  `access` = 0";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function loginAD()
    {
        $datos = func_get_args();
        $data = null;

        $query = "SELECT * FROM `usuarios` where `user`='$datos[0]' and `password`='$datos[1]' and  `access` = 1";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }

    function loginUS()
    {
        $datos = func_get_args();
        $data = null;

        $query = "SELECT * FROM `usuarios` where `user`='$datos[0]' and `password`='$datos[1]' and  `access` = 2";

        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }
    }
    /*-----------------------------------------------Fin Login-------------------------------------------------*/



    /*-----------------------------------------------Muestras-------------------------------------------------*/

    function muestraPerfilSUADM($id)
    {
        $data = null;

        $query = "SELECT * FROM `usuarios` WHERE id='$id'";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function muestraUsuarios()
    {
        $data = null;

        $query = "SELECT * FROM `usuarios`";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function muestraHCitas()
    {
        $data = null;

        $query = "SELECT * FROM `historialcitas` ORDER BY id";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function muestraCitasAD()
    {
        $data = null;

        $query = "SELECT * FROM `mcitas` ORDER BY id";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /*-----------------------------------------------Fin Muestras-------------------------------------------------*/


    
    /*-----------------------------------------------Operaciones-------------------------------------------------*/

    function actualizaHCitasSP()
    {
        $param = func_get_args();

        $query = "UPDATE `historialcitas` SET `estado`= 2 WHERE fecha = '$param[0]'";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function insertaHistorialCitasSP()
    {
        $param = func_get_args();

        $query = "INSERT INTO `historialcitas`(`idUser`, `sede`, `departamento`, `paciente`, `patologia`, `tipoCita`, `tipoEnfermedad`, `fecha`) VALUES ('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]')";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function creaCitaSP()
    {
        $param = func_get_args();
        $querySelect = "SELECT * FROM `mcitas` WHERE `fecha`='$param[7]' AND `hora`='$param[8]'";
        $result = mysqli_query($sql = $this->getConexion(), $querySelect);
        $search = mysqli_fetch_array($result);

        if (empty($search)) {
            $query = "INSERT INTO `mcitas`(`idUser`, `sede`, `departamento`, `paciente`, `patologia`, `tipoCita`, `tipoEnfermedad`, `fecha`, `hora`) VALUES ('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]')";
            $queryHisto = "INSERT INTO `historialcitas`(`idUser`, `sede`, `departamento`, `paciente`, `patologia`, `tipoCita`, `tipoEnfermedad`, `fecha`, `hora`) VALUES ('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]')";


            if ($param[5] == 'Virtual') {
                $sql = $this->getConexion()->query($query);
                $sql = $this->getConexion()->query($queryHisto);
                $param = func_get_args();
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "TLS";
                $mail->Host = "smtp.titan.email";
                $mail->Port = 587;
                $mail->Username = "reportes@spestechnical.com";
                $mail->Password = '';
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('reportes@spestechnical.com', 'CITA VIRTUAL');
                $mail->AddAddress($param[9]);
                $mail->IsHTML(true);
                $mail->Subject = "Datos de Cita Virtual";
                $mail->Body = "<h2>Sistema BIENESTAR informa:</h2>
                <p><strong>Fecha de atención: </strong>" . $param[7] . ".</p>
                <p><strong>Hora de atención: </strong>" . $param[8] . ".</p>
                <p><strong>Departamento: </strong>" . $param[2] . ".</p>
                <p><strong>Sede: </strong>" . $param[1] . ".</p>
                <p><strong>Tipo Enfermadad: </strong>" . $param[6] . ".</p>
                <p><strong>Paciente: </strong>" . $param[3] . ".</p>";
                $mail->Send();
            } else {
                $sql = $this->getConexion()->query($query);
                $sql = $this->getConexion()->query($queryHisto);
            }
            echo json_encode(array('codigo' => 1));
        } else {
            if (!empty($search)) {
                echo json_encode(array('codigo' => 2));
            }
        }
    }

    function eliminaCitaConfirmaSP()
    {
        $param = func_get_args();

        $query = "DELETE FROM `mcitas` WHERE fecha = '$param[0]'";
        if ($sql = $this->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function confirmaCitaSP()
    {
        $datos = func_get_args();

        $query = "UPDATE `historialcitas` SET `estado`= 1 WHERE id = '$datos[0]'";

        if ($sql = $this->conn->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function InsertarUsuarioSP(string $name, string $user, string $company, string $mail, string $password, string $access)
    {
        $querySelect = "SELECT * FROM `usuarios` WHERE `user`='$user'";
        $result = mysqli_query($this->conn, $querySelect);
        $search = mysqli_fetch_array($result);
        if (empty($search)) {
            if (empty($buscar)) {
                $query = "INSERT INTO `usuarios`(`name`, `company`, `user`, `mail`, `password`,`access`) VALUES ('$name','$company','$user','$mail','$password','$access')";
                $this->conn->query($query);
                echo json_encode(array("codigo" => 1));
            } else {

                if (!empty($search)) {
                    echo json_encode(array("codigo" => 2));
                }
            }
        }
    }

    function actualizaPerfilUsuariosSP()
    {
        $datos = func_get_args();

        $query = "UPDATE `usuarios` SET `name`='$datos[1]',`company`='$datos[2]', `user`='$datos[3]', `mail`='$datos[4]', `phone`='$datos[5]' WHERE `id`='$datos[0]'";

        if ($sql = $this->conn->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function editaCitaSP()
    {
        $datos = func_get_args();

        $query = "UPDATE `mcitas` SET `sede`='$datos[0]',`departamento`='$datos[1]',`paciente`='$datos[2]',`patologia`='$datos[3]',`tipoCita`='$datos[4]',`tipoEnfermedad`='$datos[5]',`fecha`='$datos[6]' WHERE id='$datos[7]'";

        if ($sql = $this->conn->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function EliminarUsuarioSP()
    {
        $datos = func_get_args();
        $query = "DELETE FROM `usuarios` WHERE `id` = '$datos[0]'";
        if ($sql = $this->conn->query($query)) {
            echo json_encode(array('exito' => true));
        } else {
            echo json_encode(array('exito' => false));
        }
    }

    function eliminaCitaSP()
    {
        $param = func_get_args();

        $query = "DELETE FROM `mcitas` WHERE id = '$param[0]'";
        if ($sql = $this->conn->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function EnviarCorreoUsuariosSP(string $name, string $user, string $password, string $correo)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "TLS";
        $mail->Host = "smtp.titan.email";
        $mail->Port = 587;
        $mail->Username = "reportes@spestechnical.com";
        $mail->Password = '';
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('reportes@spestechnical.com', 'Notificaciones');
        $mail->AddAddress($correo);
        $mail->IsHTML(true);
        $mail->Subject = "BIENESTAR Informa";
        $mail->Body = "<h1>Bienvenido a la Plataforma!</h1>
                <p><strong>Bienvenido Señor(a): </strong>" . $name . "</p>
                <p>Sus datos para el ingreso a la plataforma de citas `BIENESTAR SISTEMA` son: </p>
                <p><strong>Usuario: </strong>" . $user . "</p>
                <p><strong>Contraseña: </strong>" . $password . "</p>
                <p>Por su seguridad le recomendamos cambiar su contraseña cuando ingrese a la plataforma.</p>
                <strong>Link de la Plataforma: https://consultorios-bienestar.spestechnical.com</strong>";
        $mail->Send();
    }

    function enviaCorreoCitaSP()
    {
        try {

            $param = func_get_args();
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "TLS";
            $mail->Host = "smtp.titan.email";
            $mail->Port = 587;
            $mail->Username = "reportes@spestechnical.com";
            $mail->Password = '';
            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('reportes@spestechnical.com', 'CITA VIRTUAL');
            $mail->AddAddress('soporte@spestechnical.com');
            $mail->IsHTML(true);
            $mail->Subject = "Datos de Cita Virtual";
            $mail->Body = "<h2>Sistema BIENESTAR informa:</h2>
            <p><strong>Fecha y hora de atención: </strong>" . $param[4] . ".</p>
            <p><strong>Departamento: </strong>" . $param[1] . ".</p>
            <p><strong>Sede: </strong>" . $param[0] . ".</p>
            <p><strong>Tipo Enfermadad: </strong>" . $param[3] . ".</p>
            <p><strong>Paciente: </strong>" . $param[2] . ".</p>";
            $mail->Send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function EnviarCorreoASP(string $emisor, string $mensaje)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "TLS";
        $mail->Host = "smtp.titan.email";
        $mail->Port = 587;
        $mail->Username = "reportes@spestechnical.com";
        $mail->Password = '';
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('reportes@spestechnical.com', $emisor);
        $mail->AddAddress('soporte@spestechnical.com');
        $mail->IsHTML(true);
        $mail->Subject = "Soporte TI Spes Technical";
        $mail->Body = "<h2>Soporte para el Sistema BIENESTAR</h2>
        <p>El Usuario de tipo: " . $emisor . ", ha presentado la siguiente inconveniencia: </p>
        <p>" . $mensaje . "</p>";
        $mail->Send();
    }

    /*-----------------------------------------------Fin Operaciones-------------------------------------------------*/
}

$ObjSUADM = new SUADM();

//Actualiza Perfil
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaADM') {
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $usuario = $_POST["usuario"];
        $correo = $_POST["correo"];
        $idADM = $_POST["idADM"];

        $ObjSUADM->actualizarPerfilSUADM($idADM, $nombre, $telefono, $usuario, $correo);
    }
}

//Actualiza contra
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizacontraADM') {
        $contrasena = $_POST["contrasena"];
        $contrasena2 = $_POST["contrasena2"];
        $idAD = $_POST["idAD"];

        if ($contrasena == $contrasena2) {
            $contra = md5($contrasena);

            $ObjSUADM->actualizaContraSUADM($idAD, $contra);
        } else {
            echo json_encode(array('codigo' => 3));
        }
    }
}

//Actualiza Contra Users
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizacontraUsers') {
        $contrasena = $_POST["contrasena"];
        $contrasena2 = $_POST["contrasena2"];
        $id = $_POST["id"];

        if ($contrasena == $contrasena2) {
            $contra = md5($contrasena);

            $ObjSUADM->actualizaContraUsers($id, $contra);
        } else {
            echo json_encode(array('codigo' => 3));
        }
    }
}

//Actualiza Foto
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'actFotoUser') {

        $id = $_POST['idUser'];

        $target_path = "photos/";
        $target_path = $target_path . basename($_FILES['photo']['name']);
        $location = $target_path;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
            header('Location: perfil.php');
        } else {
            mysqli_query($ObjSUADM->getConexion(), "UPDATE `usuarios` SET photo='$location' WHERE id='$id'");
            header('Location: perfil.php');
        }
    }
}

//Crea Cita
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'creaCita') {

        $id = $_POST['iduser'];
        $tipocita = $_POST['tipocita'];
        $sede = $_POST['sede'];
        $patologia = $_POST['patologia'];
        $departamento = $_POST['departamento'];
        $paciente = $_POST['paciente'];
        $tipoenfermedad = $_POST['tipoenfermedad'];
        $fecha = $_POST['fechaCitaAD'];
        $hora = $_POST['horaCita'];
        $correoCita = $_POST['correoCita'];

        $ObjSUADM->creaCitaSP($id, $sede, $departamento, $paciente, $patologia, $tipocita, $tipoenfermedad, $fecha, $hora,$correoCita);

    }
}

//Insertar Usuario
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'NuevoUsu') {
        $name = $_POST["name"];
        $user = $_POST["user"];
        $password = $_POST["password"];
        $pass = md5($password);
        $company = $_POST["company"];
        $access = $_POST['access'];
        $mail = $_POST["mail"];

        $ObjSUADM->InsertarUsuarioSP($name, $user, $company, $mail, $pass, $access);
        $ObjSUADM->EnviarCorreoUsuariosSP($name, $user, $password, $mail);
    }
}

//Edita Cita
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaCita') {
        $IdcitaEDI = $_POST['IdcitaEDI'];
        $tipocitaEDI = $_POST['tipocitaEDI'];
        $sedeEDI = $_POST['sedeEDI'];
        $patologiaEDI = $_POST['patologiaEDI'];
        $departamentoEDI = $_POST['departamentoEDI'];
        $pacienteEDI = $_POST['pacienteEDI'];
        $tipoenfermedadEDI = $_POST['tipoenfermedadEDI'];
        $fechaEDI = str_replace('T',' ',$_POST['fechaEDI']);

        $ObjSUADM->editaCitaSP($sedeEDI, $departamentoEDI, $pacienteEDI, $patologiaEDI, $tipocitaEDI, $tipoenfermedadEDI, $fechaEDI, $IdcitaEDI);
    }
}

//Elimina Cita
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'eliminaCita') {
        $id = $_POST['IdCita'];
        $fecha = $_POST['fechaCita'];

        $ObjSUADM->actualizaHCitasSP($fecha);
        $ObjSUADM->eliminaCitaSP($id);
    }
}

//Edita Usuario
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaPerfilUSERS') {
        $id = $_POST['idADU'];
        $nombre = $_POST['nombreU'];
        $usuario = $_POST['usuarioU'];
        $empresa = $_POST['empresaU'];
        $telefono = $_POST['telefonoU'];
        $correo = $_POST['correoU'];

        $ObjSUADM->actualizaPerfilUsuariosSP($id, $nombre, $empresa, $usuario, $correo, $telefono);
    }
}

//Confirma Citas
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'CONFIRMAR') {
        $id = $_POST["checkboxmarcado"];
        $fecha = $_POST["fecha"];

        $ObjSUADM->confirmaCitaSP($id);
        $ObjSUADM->eliminaCitaConfirmaSP($fecha);
    }
}

//Elimina Usuario
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'borraUsuario') {
        $IdADU = $_POST["IdADU"];

        $ObjSUADM->EliminarUsuarioSP($IdADU);
    }
}

//Envia Correo Soporte
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'enviaCA') {
        $emisor = $_POST["emisor"];
        $mensaje = $_POST["mensaje"];
        $ObjSUADM->EnviarCorreoASP($emisor, $mensaje);
    }
}
