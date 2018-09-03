<?php
    require_once "../front/atendente.php";
    if (session_status() != PHP_SESSION_NONE) {
        session_unset();
        session_destroy();
    }

    exit();
?>