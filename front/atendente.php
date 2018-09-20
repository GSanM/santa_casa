<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Santa Casa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="media/Icons/png/asterisk.png">

		<link rel="stylesheet" type="text/css" media="screen" href="css/atendente.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />

		<!--Fontes-->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Amatic+SC|Archivo+Narrow|Exo|Anton|Josefin+Sans|Lobster" rel="stylesheet">
		<!--======-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/atendente.js"></script>
		<script type="text/javascript" src="js/post.js"></script>

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
				<img src="media/Icons/png/appointment-book.png" width="5%">
				<h1 id="h1-atendente"> Atendente </h1>
			</div>
			<div class="btn-group"  id="root-buttons">
				<button id="cadastrar" class="btn btn-default">Cadastrar</button>
				<button class="btn btn-default" id="agenda">Consultas</button>
				<button class="btn btn-default" id="sair" onclick="ajaxPost('../server/sair.php'), sair()">Sair</button>
			</div>

			<!--Cadastro-->
			<div class="collapse" id="cadastro">
				<form name="form_cadastro" id="form_cadastro" onsubmit="return false;">
					<div class="border">
						<h2>Cadastro</h2>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="name" class="form-control" type="text" name="name" placeholder="Nome" required>
							<input id="age" class="form-control" type="date" name="age" placeholder="Data de Nascimento" required>
							<input id="cpf" class="form-control" maxlength="14" type="text" autocomplete="off" name="cpf" placeholder="CPF" onkeypress="aplicaMascara(this, cpfMask)" required>
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input id="email" class="form-control" type="email" name="email" placeholder="E-mail" required>
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
							<input id="address" class="form-control" type="text" name="address" placeholder="Endereço" required>
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<input id="phone" class="form-control" type="tel" name="phone" maxlength="14" onkeypress="aplicaMascara(this, telMask)" placeholder="Telefone" required>
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="username" class="form-control" type="text" name="username" placeholder="Usuario" required>
						</div>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" class="form-control" type="password" name="password" placeholder="Senha" required>
						</div>

						<!--Medico-->

						<div class="collapse" id="doctor-div">
							<fieldset>
								<legend>Médico</legend>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
									<input id="crm" class="form-control" type="text" name="crm" placeholder="CRM" required>
									<input id="spec" class="form-control" type="text" name="spec" placeholder="Especialidade" required>
								</div>

								<div class="collapse-in" id="unique_day">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
										<input id="appointment_hour_start_all" class="form-control hour-inline" type="time" name="appointment_hour_start_all">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_all" class="form-control hour-inline" type="time" name="appointment_hour_end_all">
									</div>
								</div>

								<button class="btn btn-default" id="show_all_days">Horário/Dia</button>

								<!--Expediente médico dias da semana-->
								<div class="collapse" id="week_days">
									<div class="input-group">
										<span class="input-group-addon">SEG</span>
										<input id="appointment_hour_start_mon" class="form-control hour-inline" type="time" name="appointment_hour_start_mon">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_mon" class="form-control" type="time" name="appointment_hour_end_mon">
									</div>

									<div class="input-group">
										<span class="input-group-addon">TER</span>
										<input id="appointment_hour_start_tue" class="form-control hour-inline" type="time" name="appointment_hour_start_tue">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_tue" class="form-control" type="time" name="appointment_hour_end_tue">
									</div>

									<div class="input-group">
										<span class="input-group-addon" id="qua">QUA</span>
										<input id="appointment_hour_start_wed" class="form-control hour-inline" type="time" name="appointment_hour_start_wed">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_wed" class="form-control" type="time" name="appointment_hour_end_wed">
									</div>

									<div class="input-group">
										<span class="input-group-addon">QUI</span>
										<input id="appointment_hour_start_thu" class="form-control hour-inline" type="time" name="appointment_hour_start_thu">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_thu" class="form-control" type="time" name="appointment_hour_end_thu">
									</div>

									<div class="input-group">
										<span class="input-group-addon">SEX</span>
										<input id="appointment_hour_start_fri" class="form-control hour-inline" type="time" name="appointment_hour_start_fri">
										<span class="span-ate">até</span>
										<input id="appointment_hour_end_fri" class="form-control" type="time" name="appointment_hour_end_fri">
									</div>
								</div>
							</fieldset>
						</div>

						<!--Radio Buttons-->
						<div class="btn-group" name="radio-pac-doc" id="pac-doc">
							<label class="btn btn-default form-check-label" style="font-weight: bold; width: 100px;">
								<input class="form-check-input" type="radio" name="pac_doc" value="patient" id="patient" checked>
								<span class="pac-doc-span" style="margin-left: -10px;">Paciente</span>
							</label>

							<label class="btn btn-default form-check-label" style="font-weight: bold; width: 100px;">
								<input class="form-check-input" type="radio" name="pac_doc" value="doctor" id="doctor">
								<span class="pac-doc-span" style="margin-left: -22px;">Médico</span>
							</label>
						</div>

						<div class="submit-button">
							<button type="submit" class="btn btn-default" id="btnCadastrar" onclick="ajaxPost('../server/cadastrar.php', '#resultado-cadastro')" >Cadastrar</button>
						</div>

					</div>
				</form>
				<div id="resultado-cadastro"></div>
			</div>

			<!--Agenda-->
			<div class="collapse" id="agenda-div">
				<div class="border">
					<h2>Agenda</h2>
					<div class="btn-group">
						<button class="btn btn-default" id="agendar">Agendar</button>
						<button class="btn btn-default" id="alterar-consulta">Alterar</button>
						<button type="submit" class="btn btn-default" id="confirmar-consulta" onclick="ajaxPost('../server/mostrarConsultasPendentes.php', '#resultado-consulta-pendente')">Confirmar</button>
						<button class="btn btn-default" id="ver-agenda-medico" onclick="ajaxPost('../server/verTodosMedicos.php', '#result-verAgenda')">Medico</button>
						<button class="btn btn-default" id="ver-agenda-paciente">Paciente</button>
					</div>

					
					<div class="collapse" id="agendar-div">
		
						<h3>Agendar Consulta</h3>
		
						<form name="form_agendar" id="form_agendar" onsubmit="return false;">

							<!--Nome Paciente-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input list="patients" id="patient-name" class="form-control" type="text" name="patient-name" placeholder="Nome do Paciente" required>
								<datalist id="patients">
								<?php
										$dom_xml = new DOMDocument();
										$dom_xml->load("../server/database/Pacientes.xml");

										$medicos = $dom_xml->getElementsByTagName("Paciente");

										foreach( $medicos as $medico ) {
											$nomes = $medico->getElementsByTagName("nome");
											$nome = $nomes->item(0)->nodeValue;
											echo "<option value=\"$nome\">";
										}
									?>
								</datalist>
							</div>

							<!--Nome Médico-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
								<input list="doctors" id="med-name" class="form-control" type="text" name="med-name" placeholder="Nome do Médico" required>
								<datalist id="doctors">
									<?php
										$dom_xml = new DOMDocument();
										$dom_xml->load("../server/database/Medicos.xml");

										$medicos = $dom_xml->getElementsByTagName("Medico");

										foreach( $medicos as $medico ) {
											$nomes = $medico->getElementsByTagName("nome");
											$nome = $nomes->item(0)->nodeValue;
											echo "<option value=\"$nome\">";
										}
									?>
								</datalist>
							</div>

							<!--Horário-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
								<input id="appointment_day" name="appointment_day" class="form-control" type="date" required>
								<input id="appointment_hour" name="appointment_hour" class="form-control" type="time" required>
							</div>

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnAgendar" onclick="ajaxPost('../server/agendar.php', '#result-agendar')">Agendar</button>
							</div>
						</form>
						<div id="result-agendar"></div>
					</div>	
					
					<div class="collapse" id="alterar-consulta-div">
						<h3>Alterar Consulta</h3>
						<form name="form_alterarConsulta" id="form_alterarConsulta" onsubmit="return false;" >

						<!--Nome Paciente-->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input list="patients" id="patient-name-alt" class="form-control" type="text" name="patient-name-alt" placeholder="Nome do Paciente" required>
						</div>

						<!--Nome Médico-->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
							<input list="doctors" id="doctor-name-alt" class="form-control" type="text" name="doctor-name-alt" placeholder="Nome do Médico" required>
							<datalist id="doctors"></datalist>
						</div>

						<div class="submit-button" id="submit-agenda">
							<button type="submit" class="btn btn-default" id="btnAlterarConsulta" onclick="ajaxPost('../server/buscarConsulta.php', '#result-buscarConsulta')">Buscar</button>
						</div>
						</form>
						<div id="result-buscarConsulta"></div>
						<form onsubmit="return false;">
						<h3>Insira o horário antigo</h3>
						<!--Horário-->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
							<input id="appointment_day_alterar_antigo" name="appointment_day_alterar_antigo" class="form-control" type="date" required>
							<input id="appointment_hour_alterar_antigo" name="appointment_hour_alterar_antigo" class="form-control" type="time" required>
						</div>

						<h3>Insira o novo horário</h3>
						<!--Horário-->
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
							<input id="appointment_day_alterar_novo" name="appointment_day_alterar_novo" class="form-control" type="date" required>
							<input id="appointment_hour_alterar_novo" name="appointment_hour_alterar_novo" class="form-control" type="time" required>
							<input list="doctors" id="doctor-name-alterar" class="form-control" type="text" name="doctor-name-alterar" placeholder="Nome do Médico" required>
						</div>

						<div class="submit-button" id="submit-agenda-alterar">
							<button type="submit" class="btn btn-default" id="btnAgendar_alterar" onclick="ajaxPost('../server/alterarConsulta.php', '#result-agendar-alterar')">Alterar</button>
						</div>

						</form>
						<div id="result-agendar-alterar">CHECK</div>
					</div>
					
					<!--Resultados das consultas pendentes-->
					<div class="collapse" id="resultado-consulta-pendente"></div>

					<div class="collapse" id="ver-agenda-medico-div">
						<h3>Médicos Cadastrados no Sistema</h3>
						<br>
						<div id="result-verAgenda"></div>
						<br><br>
						
						<form name="form_verAgenda" id="form_verAgendaMedico" onsubmit="return false;">
							<!--Nome Médico-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
								<input list="doctors" id="doctor-name-ver" class="form-control" type="text" name="doctor-name-ver" placeholder="Nome do Médico" required>
								<datalist id="doctors"></datalist>
							</div>

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnVerAgenda" onclick="ajaxPost('../server/verAgendaSimplificadaMedico.php', '#result-verAgenda')">Buscar</button>
							</div>
						</form>

						</form>
						
					</div>

					<div class="collapse" id="ver-agenda-paciente-div">
						<h3>Ver agenda de pacientes</h3>

						<form name="form_verAgendaPaciente" id="form_verAgendaPaciente" onsubmit="return false;">

							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
								<input list="patients" id="patient-name-ver-agenda" class="form-control" type="text" name="patient-name-ver-agenda" placeholder="Nome do Paciente" required>
								<datalist id="patients"></datalist>
							</div>

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnVerAgendaPaciente" onclick="ajaxPost('../server/verAgendaSimplificadaPaciente.php', '#result-verAgendaPaciente')">Buscar</button>
							</div>
						</form>
						<div id="result-verAgendaPaciente"></div>

				</div>
			</div>

		</div>



	</body>
</html>
