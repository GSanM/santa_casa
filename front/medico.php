<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Santa Casa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="media/Icons/png/asterisk.png">

		<link rel="stylesheet" type="text/css" media="screen" href="css/medic.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />

		<!--Fontes-->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Amatic+SC|Archivo+Narrow|Exo|Anton|Josefin+Sans|Lobster" rel="stylesheet">  
		<!--======-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/post.js"></script>
		<script src="js/medi.js"></script>
		<script src="js/atendente.js"></script> <!--Pelas mascaras-->
        <?php
			session_start();
			if((!isset ($_SESSION['cpf']) == true) and (!isset ($_SESSION['senha']) == true)) {
				session_destroy();
				header('Location: login.html');
			}
        ?>
	</head>
    <body>
        <div class="container">
            <div class="header">
				<img src="media/Icons/png/stethoscope.png" width="5%"> 
				<?php
                    echo "<h1>";
                    echo ((date('H')) >= 3 && (date('H')) < 9) ? "Boa Madrugada, " : "";
                    echo ((date('H')) >= 9 && (date('H')) < 15) ? "Bom Dia, " : "";
                    echo ((date('H')) >= 15 && (date('H')) < 21) ? "Boa Tarde, " : "";
                    echo ((date('H')) >= 21 || (date('H')) < 3) ? "Boa Noite, " : "";
                    echo "Dr(a). " . $_SESSION['nome'] . "</h1><br><br>";
                ?>
			</div>
            
            <div class="btn-group">
                <button class="btn btn-default" id="agenda" onclick="ajaxPost('../model/agendaMedico.php', '#result-verAgenda')"><i class="glyphicon glyphicon-book"></i> Agenda</button>
				<button class="btn btn-default" id="perfil" ><i class="glyphicon glyphicon-user"></i> Meu Perfil</button>
				<button class="btn btn-default" id="ver-historico"><i class="glyphicon glyphicon-paste"></i> Ver Histórico</button>
				<button class="btn btn-default" id="sair" onclick="ajaxPost('../server/sair.php'), sair()"><i class="glyphicon glyphicon-log-out"></i> Sair</button>
            </div>

            <div class="collapse" id="agenda_div">
                <div class="border">
                    <h2>Agenda</h2>
					<div id="result-verAgenda"></div>
                </div>
            </div>

            <div class="collapse" id="cadastro_div">
		
			<!--Cadastro-->
	
				<form name="form_cadastro" id="form_cadastro" onsubmit="return false;">
					<div class="border">
						<div class="header-perfil">
							<br><br>
								<img src="media/Icons/png/appointment-book.png" width="8%"> 
								
								<h1 id="h1-atendente"> Meu Perfil </h1>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="name" class="form-control" type="text" name="name" value="<?php echo $_SESSION['nome'];?>" placeholder="Nome" required> 
							<input id="age" class="form-control" type="date" name="age" value=<?php echo $_SESSION['idade'];?> required> 
						</div>
					
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input id="email" class="form-control" type="email" name="email" value=<?php echo $_SESSION['email'];?> placeholder="E-mail" required> 
						</div>
		
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
							<input id="address" class="form-control" type="text" name="address" value="<?php echo $_SESSION['endereco'];?>" placeholder="Endereço" required> 
						</div>
		
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<input id="phone" class="form-control" type="tel" name="phone" maxlength="14" onkeypress="aplicaMascara(this, telMask)" value=<?php echo $_SESSION['telefone'];?>  required> 
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" class="form-control" type="password" name="password" placeholder="Digite sua senha" autocomplete="off" required> 
						</div>
						
						<!--Medico-->
				
                        <br>
							<fieldset>
                            
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
									<input id="crm" class="form-control" type="text" name="crm" value=<?php echo $_SESSION['crm'];?> placeholder="CRM" required> 
									<input id="spec" class="form-control" type="text" name="spec" value="<?php echo $_SESSION['especialidade'];?>" placeholder="Especialidade" required>
								</div>
                                <br>
								<div class="collapse-in" id="unique_day">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
										<input id="appointment_hour_start_all" class="form-control hour-inline" type="time" name="appointment_hour_start_all" value=<?php echo $_SESSION['ini-all'];?> >
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_all" class="form-control hour-inline" type="time" name="appointment_hour_end_all" value=<?php echo $_SESSION['fim-all'];?>>
									</div>
								</div>
								
								<button class="btn btn-default" id="show_all_days">Horário/Dia</button>

								<!--Expediente médico dias da semana-->
								<div class="collapse" id="week_days">
									<div class="input-group">
										<span class="input-group-addon">SEG</span>
										<input id="appointment_hour_start_mon" class="form-control hour-inline" type="time" name="appointment_hour_start_mon" value=<?php echo $_SESSION['ini-expediente-seg'];?>>
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_mon" class="form-control" type="time" name="appointment_hour_end_mon" value=<?php echo $_SESSION['fim-expediente-seg'];?>>
									</div>
									
									<div class="input-group">
										<span class="input-group-addon">TER</span>
										<input id="appointment_hour_start_tue" class="form-control hour-inline" type="time" name="appointment_hour_start_tue" value=<?php echo $_SESSION['ini-expediente-ter'];?>>
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_tue" class="form-control" type="time" name="appointment_hour_end_tue" value=<?php echo $_SESSION['fim-expediente-ter'];?>>
									</div>

									<div class="input-group">
										<span class="input-group-addon" id="qua">QUA</span>
										<input id="appointment_hour_start_wed" class="form-control hour-inline" type="time" name="appointment_hour_start_wed" value=<?php echo $_SESSION['ini-expediente-qua'];?>>
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_wed" class="form-control" type="time" name="appointment_hour_end_wed" value=<?php echo $_SESSION['fim-expediente-qua'];?>>
									</div>

									<div class="input-group">
										<span class="input-group-addon">QUI</span>
										<input id="appointment_hour_start_thu" class="form-control hour-inline" type="time" name="appointment_hour_start_thu" value=<?php echo $_SESSION['ini-expediente-qui'];?>>
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_thu" class="form-control" type="time" name="appointment_hour_end_thu" value=<?php echo $_SESSION['fim-expediente-qui'];?>>
									</div>
									
									<div class="input-group">
										<span class="input-group-addon">SEX</span>
										<input id="appointment_hour_start_fri" class="form-control hour-inline" type="time" name="appointment_hour_start_fri" value=<?php echo $_SESSION['ini-expediente-sex'];?>>
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_fri" class="form-control" type="time" name="appointment_hour_end_fri" value=<?php echo $_SESSION['fim-expediente-sex'];?>>
									</div>
								</div>
							</fieldset>
			
						<div class="submit-button">
							<button type="submit" class="btn btn-default" id="btnAlterar" onclick="ajaxPost('../server/alterarCadastroMedico.php', '#resultado-cadastro')"> Salvar </button>
						</div>

					</div>
				</form>
				<div id="resultado-cadastro"></div>
		
			</div>

			<!--Historico de paciente-->
			<div class="collapse" id="ver-historico-div">
				<div class="border">
					<h2>Histórico do Paciente</h2>
					<form id="form_historico" onsubmit="return false;">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input list="patients" id="patient-name" class="form-control" type="text" name="patient-name" placeholder="Nome do Paciente" required> 
							<datalist id="patients">
								<?php
									require_once "../model/getPacientes.php";
								?>
							</datalist>
						</div>
						<button type="submit" class="btn btn-default" id="btnHistorico" onclick="ajaxPost('../model/historicoPaciente.php', '.result-historico')">Histórico</button>
					</form>
					<div class="result-historico"></div>
					<!-- The Modal -->
					<div id="myModal" class="modal">
						<!-- Modal content -->
						<div class="modal-content">
							<span class="close">&times;</span>
							<form method="POST" action="../model/consulta.php">
								<h2>Diagnóstico</h2>
								<textarea rows="4" cols="50" name="diagnostico" placeholder="Insira o diagnóstico do paciente..."></textarea>
								<br>

								<h2>Receita</h2>
								<textarea rows="4" cols="50" name="receita" placeholder="Insira a receita do paciente..."></textarea>
								<br>
								<button class="btn btn-default" type="submit">Enviar</button>
							</form>
						</div>
					</div>
				</div>
			</div>

        </div>
        
    </body>
</html>
