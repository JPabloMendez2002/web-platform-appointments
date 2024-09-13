<?php

require('../superadmin/claseSUADMIN.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ADM extends SUADM
{
    /*-----------------------------------------------Perfil--------------------------------------------------*/

    function actualizarPerfilADM(string $idADM, string $nombre, string $telefono, string $usuario, string $correo)
    {
        $query = "UPDATE `usuarios` SET `name`='$nombre', `phone`='$telefono', `user`='$usuario', `mail` ='$correo' WHERE id='$idADM'";
        if ($sql = $this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function actualizaContraADM(string $idADM, string $contrasena)
    {
        $query = "UPDATE `usuarios` SET `password`='$contrasena' WHERE id='$idADM'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('codigo' => 1));
        } else {
            echo json_encode(array('codigo' => 2));
        }
    }

    /*-----------------------------------------------Fin Perfil-------------------------------------------------*/



    /*-----------------------------------------------Muestras-------------------------------------------------*/

    function muestraPerfilADM($id)
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

        $query = "SELECT * FROM `usuarios` WHERE `access` = 2";
        if ($sql = $this->getConexion()->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /*-----------------------------------------------Fin Muestras-------------------------------------------------*/



    /*-----------------------------------------------Operaciones-------------------------------------------------*/

    function editaCita()
    {
        $datos = func_get_args();

        $query = "UPDATE `mcitas` SET `sede`='$datos[0]',`departamento`='$datos[1]',`paciente`='$datos[2]',`patologia`='$datos[3]',`tipoCita`='$datos[4]',`tipoEnfermedad`='$datos[5]',`fecha`='$datos[6]' WHERE id='$datos[7]'";

        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function actualizaPerfilUsuarios()
    {
        $datos = func_get_args();

        $query = "UPDATE `usuarios` SET `name`='$datos[1]',`company`='$datos[2]', `user`='$datos[3]', `mail`='$datos[4]', `phone`='$datos[5]' WHERE `id`='$datos[0]'";

        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function creaCitaAD()
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



    function actualizaHCitas()
    {
        $param = func_get_args();

        $query = "UPDATE `historialcitas` SET `estado`= 2 WHERE fecha = '$param[0]'";
        if ($sql = $this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    function confirmaCita()
    {
        $datos = func_get_args();

        $query = "UPDATE `historialcitas` SET `estado`= 1 WHERE id = '$datos[0]'";

        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function eliminaCita()
    {
        $param = func_get_args();

        $query = "DELETE FROM `mcitas` WHERE id = '$param[0]'";
        if ($sql = $this->getConexion()->query($query)) {
            echo json_encode(array('response' => true));
        } else {
            echo json_encode(array('response' => false));
        }
    }

    function eliminaCitaConfirma()
    {
        $param = func_get_args();

        $query = "DELETE FROM `mcitas` WHERE fecha = '$param[0]'";
        if ($sql = $this->getConexion()->query($query)) {
            return true;
        } else {
            return false;
        }
    }


    function EnviarCorreoA(string $emisor, string $mensaje)
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


    /*-----------------------------------------------Fin Operaciones-------------------------------------------------*/
}

$ObjADM = new ADM();

//Actualiza Perfil
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaADM') {
        $nombre = $_POST["nombre"];
        $telefono = $_POST["telefono"];
        $usuario = $_POST["usuario"];
        $correo = $_POST["correo"];
        $idADM = $_POST["idADM"];

        $ObjADM->actualizarPerfilADM($idADM, $nombre, $telefono, $usuario, $correo);
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

            $ObjADM->actualizaContraADM($idAD, $contra);
        } else {
            echo json_encode(array('codigo' => 3));
        }
    }
}

//Envia Correo Soporte
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'enviaCA') {
        $emisor = $_POST["emisor"];
        $mensaje = $_POST["mensaje"];
        $ObjADM->EnviarCorreoA($emisor, $mensaje);
    }
}

//Envia Correo Doctora
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'enviaCADOC') {
        $emisor = $_POST["emisorDOC"];
        $mensaje = $_POST["mensajeDOC"];
        $ObjADM->EnviarCorreoDOC($emisor, $mensaje);
    }
}

//Edita Cita
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaCitaAD') {
        $IdcitaEDI = $_POST['IdcitaEDI'];
        $tipocitaEDI = $_POST['tipocitaEDI'];
        $sedeEDI = $_POST['sedeEDI'];
        $patologiaEDI = $_POST['patologiaEDI'];
        $departamentoEDI = $_POST['departamentoEDI'];
        $pacienteEDI = $_POST['pacienteEDI'];
        $tipoenfermedadEDI = $_POST['tipoenfermedadEDI'];
        $fechaEDI = str_replace('T', ' ', $_POST['fechaEDI']);

        $ObjADM->editaCita($sedeEDI, $departamentoEDI, $pacienteEDI, $patologiaEDI, $tipocitaEDI, $tipoenfermedadEDI, $fechaEDI, $IdcitaEDI);
    }
}

//Edita Usuario
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'actualizaPerfilUSERSAD') {
        $id = $_POST['idADU'];
        $nombre = $_POST['nombreU'];
        $usuario = $_POST['usuarioU'];
        $empresa = $_POST['empresaU'];
        $telefono = $_POST['telefonoU'];
        $correo = $_POST['correoU'];

        $ObjADM->actualizaPerfilUsuarios($id, $nombre, $empresa, $usuario, $correo, $telefono);
    }
}

//Elimina Usuario
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'borraUsuario1') {
        $IdADU = $_POST["IdADU"];

        $ObjADM->EliminarUsuariosp($IdADU);
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
            mysqli_query($ObjADM->getConexion(), "UPDATE `usuarios` SET photo='$location' WHERE id='$id'");
            header('Location: perfil.php');
        }
    }
}

//Crea Cita
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'creaCitaAD') {

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

        $ObjADM->creaCitaAD($id, $sede, $departamento, $paciente, $patologia, $tipocita, $tipoenfermedad, $fecha, $hora,$correoCita);
    }
}

//Elimina Cita
if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'eliminaCitaAD') {
        $id = $_POST['IdCita'];
        $fecha = $_POST['fechaCita'];

        $ObjADM->actualizaHCitas($fecha);
        $ObjADM->eliminaCita($id);
    }
}

//Confirma Citas
if (isset($_POST["accion"])) {
    if ($_POST["accion"] == 'CONFIRMARAD') {
        $id = $_POST["checkboxmarcado"];
        $fecha = $_POST["fecha"];

        $ObjADM->confirmaCita($id);
        $ObjADM->eliminaCitaConfirma($fecha);
    }
}
