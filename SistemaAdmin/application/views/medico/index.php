<?php require_once ('header.php')?>
<h3 style="text-align: center; margin-top:20px">Bom Dia Dr. 
<?php
    if (session_status() != PHP_SESSION_NONE) {
        echo $this->session->userdata('nome');
    }
?>
</h3>
<p>
Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
</p>
<?php require_once ('application/views/footer.php')?>