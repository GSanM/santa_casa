<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login SGSSH</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="media/Icons/png/asterisk.png">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/login.css')?>" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!--Fontes-->
        <link href='https://fonts.googleapis.com/css?family=Amiko' rel='stylesheet'>		
        <!--======-->

    </head>
    <body>

    <div class="caixa">

        <h2>
            <?php 
                if(isset($mensagem))
                    echo $mensagem;
            ?>
        </h2>

        <form class="form" action="login/verificar" method="POST">       
            <h2 style="margin-bottom:30px">Login</h2>
            
            <input type="text" class="form-input" name="username" placeholder="Usuário" required="" autofocus="" />
            <input type="password" class="form-input" name="password" placeholder="Senha" required=""/>      
    
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
        </form>
    </div>
        
    </body>
</html>