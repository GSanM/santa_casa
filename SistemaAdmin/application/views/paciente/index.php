<?php require_once ('header.php')?>
<h3 style="text-align: center; margin-top:20px">Bom Dia. 
<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo $this->session->userdata('nome');
    }
?>
</h3>
<p>
</p>
<?php require_once ('application/views/footer.php')?>