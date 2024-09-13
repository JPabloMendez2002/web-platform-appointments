<?php

require('../admin/claseADM.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User extends ADM
{

    /*-----------------------------------------------Perfil--------------------------------------------------*/

    function muestraPerfilC()
    {
        $data = null;
        $param = func_get_args();

        $query = "SELECT * FROM `usuarios` WHERE id = '$param[0]'";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    function actualizarPerfilC()
    {

        $param = func_get_args();

        $query = "UPDATE `usuarios` SET `name`='$param[0]',`company`='$param[1]',`user`='$param[2]',`mail`='$param[3]',`phone`='$param[4]' WHERE id='$param[5]'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function actualizaContra()
    {
        $param = func_get_args();

        $pass = md5($param[0]);

        $query = "UPDATE `usuarios` SET `password`='$pass' WHERE id='$param[1]'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    /*-----------------------------------------------Fin Perfil-------------------------------------------------*/



    /*-----------------------------------------------Muesta Citas--------------------------------------------------*/

    function muestraCitas()
    {
        $data = null;
        $param = func_get_args();

        $query = "SELECT * FROM `mcitas` WHERE iduser = '$param[0]' ORDER BY id";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }


    function muestraHistorialCitas()
    {
        $data = null;
        $param = func_get_args();

        $query = "SELECT * FROM `historialcitas` WHERE idUser = '$param[0]' ORDER BY id";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    /*-----------------------------------------------Fin Muesta Citas--------------------------------------------------*/



    /*-----------------------------------------------Operaciones--------------------------------------------------*/

    function creaCitaU()
    {
        $param = func_get_args();
        $querySelect = "SELECT * FROM `mcitas` WHERE `fecha`='$param[7]' AND `hora`='$param[8]'";
        $result = mysqli_query($sql = $this->getConexion(), $querySelect);
        $search = mysqli_fetch_array($result);

        if (empty($search)) {
            $query = "INSERT INTO `mcitas`(`idUser`, `sede`, `departamento`, `paciente`, `patologia`, `tipoCita`, `tipoEnfermedad`, `fecha`, `hora`) VALUES ('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]')";
            $queryHisto = "INSERT INTO `historialcitas`(`idUser`, `sede`, `departamento`, `paciente`, `patologia`, `tipoCita`, `tipoEnfermedad`, `fecha`, `hora`) VALUES ('$param[0]','$param[1]','$param[2]','$param[3]','$param[4]','$param[5]','$param[6]','$param[7]','$param[8]')";
            $sql = $this->getConexion()->query($query);
            $sql = $this->getConexion()->query($queryHisto);
            echo json_encode(array('codigo' => 1));
        }else{
            if (!empty($search)) {
                echo json_encode(array('codigo' => 2));
            }
        }

    }



    function enviaCorreoCita()
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

    function EnviarCorreoU(string $emisor, string $mensaje)
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

    function EnviarCorreoDOC(string $emisor, string $mensaje)
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
        $mail->AddAddress('bienestarss@outlook.es');
        $mail->IsHTML(true);
        $mail->Subject = "Mensajes Plataforma";
        $mail->Body = "<h2>Reportes para el Sistema BIENESTAR</h2>
        <p>La siguiente persona " . $emisor . ", te ha dejado el siguiente mensaje: </p>
        <p><strong>" . $mensaje . "</strong></p>";
        $mail->Send();
    }

    /*-----------------------------------------------Fin Operaciones--------------------------------------------------*/
}

$userClass = new User();

//Crea Cita
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'creaCitaU') {

        $id = $_POST['iduser'];
        $tipocita = $_POST['tipocita'];
        $sede = $_POST['sede'];
        $patologia = $_POST['patologia'];
        $departamento = $_POST['departamento'];
        $paciente = $_POST['paciente'];
        $tipoenfermedad = $_POST['tipoenfermedad'];
        $fecha = $_POST['fechaCita'];
        $hora = $_POST['horaCita'];

        $userClass->creaCitaU($id, $sede, $departamento, $paciente, $patologia, $tipocita, $tipoenfermedad, $fecha, $hora);
    }
}


//Actualiza Datos Perfil
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'actPerfilUser') {

        $id = $_POST['id'];
        $company = $_POST['company'];
        $user = $_POST['user'];
        $mail = $_POST['mail'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];

        $userClass->actualizarPerfilC($name, $company, $user, $mail, $phone, $id);
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
            mysqli_query($userClass->getConexion(), "UPDATE `usuarios` SET photo='$location' WHERE id='$id'");
            header('Location: perfil.php');
        }
    }
}

//Actualiza Contra
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'actPassUser') {

        $id = $_POST['id'];
        $pass = $_POST['pass'];

        $userClass->actualizaContra($pass, $id);
    }
}

//Correo Soporte
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'enviaCorreoSoporte') {
        $emisor = $_POST["emisor"];
        $mensaje = $_POST["mensaje"];

        $userClass->EnviarCorreoU($emisor, $mensaje);
    }
}


//Envia Correo Doctora
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'enviaCADOC') {
        $emisor = $_POST["emisorDOC"];
        $mensaje = $_POST["mensajeDOC"];
        $userClass->EnviarCorreoDOC($emisor, $mensaje);
    }
}
