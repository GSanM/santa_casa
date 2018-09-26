<?php
    //require_once "../front/atendente.php";
    require_once "../front/paciente.php";
    //require_once "../front/medico.php";
    
    if (session_status() != PHP_SESSION_NONE) {
        session_unset();
        session_destroy();
    }

    exit();
?>