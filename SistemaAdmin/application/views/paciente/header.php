<html>
<head>
<meta charset="utf-8">
<title>SUP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--------------------- CSS --------------------->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/paciente.css')?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- ==========================================-->

<!--------------------- JS --------------------->
<script src="<?php echo base_url('assets/js/jquery-3.3.1.js')?>"></script>
<script src="<?php echo base_url('assets/js/paciente.js')?>"></script>
<!-- ==========================================-->

<link href='https://fonts.googleapis.com/css?family=Amiko' rel='stylesheet'>
</head>

<body>
<div class="conteudo">	
	<div class="base-central">	
		<div class="base-topo">
            Sistema Universal de Pacientes
		</div>
		
		<nav class="menu">
            <ul>
                <li><a href="<?php echo base_url('paciente/agenda')?>">Consultas</a></li>
                <li><a href="<?php echo base_url('paciente/agendar')?>">Agendar</a></li>
                <li><a href="<?php echo base_url('paciente/historico')?>">Historico</a></li>
                <li><a href="<?php echo base_url('paciente/clinicas')?>">Clinicas</a></li>
                <li><a href="<?php echo base_url('paciente/pacientes')?>">Medicos</a></li>
                <li><a href="<?php echo base_url('autenticacao/logout')?>">Sair</a></li>
            </ul>
        </nav>	