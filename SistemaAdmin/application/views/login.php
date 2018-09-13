<!DOCTYPE html>
<html>
    <?php
        if (isset($this->session->userdata['logged_in'])) {
            header("location: http://localhost/login/index.php/autenticacao/autenticar");
        }
    ?>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="media/Icons/png/asterisk.png">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/login.css')?>" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!--Fontes-->
        <link href='https://fonts.googleapis.com/css?family=Amiko' rel='stylesheet'>		
        <!--======-->

    </head>
    <body>
=
    <?php echo validation_errors('<div class="alerta">','</div>');?>

    <div class="caixa">
        <form class="form" action="<?php echo base_url('')?>autenticacao/autenticar" method="POST">       
            <h2 style="margin-bottom:30px">Login</h2>
            
            <input type="text" class="form-input" name="username" placeholder="Usuário" required="" autofocus=""  autocomplete="on"/>
            <input type="password" class="form-input" name="password" placeholder="Senha" required=""  autocomplete="on"/>      
    
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
        </form>
    </div>
        
    <?php
        if (isset($message_display)) {
            echo "<div class='alerta fundo-verde'>";
            echo $message_display;
            echo "</div>";
        }
    ?>

    <?php
        if (isset($mensagem_erro)) {
            echo "<div class='alerta fundo-vermelho'>";
            echo $mensagem_erro;
            echo "</div>";
        }
    ?>
    </body>
</html>