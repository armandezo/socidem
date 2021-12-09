<?php
$perfil_session = $_SESSION["perfil"];

    switch ($perfil_session) {
        case "admin":
            echo '<script>window.location = "adminDash";</script>';
            break;
        case "vendedor":
            return;
            break;
        case "cliente":
            return;
            break;
        default:
        echo '<script>window.location = "inicio";</script>';
            break;
    }



     
?>