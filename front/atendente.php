<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Santa Casa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="media/Icons/png/asterisk.png">

		<link rel="stylesheet" type="text/css" media="screen" href="css/atendente.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="css/tblhorario.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />

		<!--Fontes-->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Amatic+SC|Archivo+Narrow|Exo|Anton|Josefin+Sans|Lobster" rel="stylesheet">
		<!--======-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/atendente.js"></script>
		<script src="js/tblhorario.js"></script>
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
							
								<legend>Médico</legend>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
									<input id="crm" class="form-control" type="text" name="crm" placeholder="CRM" required>
									<input id="spec" class="form-control" type="text" name="spec" placeholder="Especialidade" required>
								</div>

								<table id="tbl">
									<thead>
										<tr>
										<th class="date-column"></th>
										<th>08h00</th>
										<th>09h00</th>
										<th>10h00</th>
										<th>11h00</th>
										<th>12h00</th>
										<th>13h00</th>
										<th>14h00</th>
										<th>15h00</th>
										<th>16h00</th>
										<th>17h00</th>
										<th>18h00</th>
										</tr>
									</thead>

									<tbody>
										<tr>
											<td>Segunda-Feira</td>
											<td id="seg8"  onclick="content(this)"></td>
											<td id="seg9"  onclick="content(this)"></td>
											<td id="seg10" onclick="content(this)"></td>
											<td id="seg11" onclick="content(this)"></td>
											<td id="seg12" onclick="content(this)"></td>
											<td id="seg13" onclick="content(this)"></td>
											<td id="seg14" onclick="content(this)"></td>
											<td id="seg15" onclick="content(this)"></td>
											<td id="seg16" onclick="content(this)"></td>
											<td id="seg17" onclick="content(this)"></td>
											<td id="seg18" onclick="content(this)"></td>
										</tr>

										<tr>
											<td>Terça-Feira</td>
											<td id="ter8"  onclick="content(this)"></td>
											<td id="ter9"  onclick="content(this)"></td>
											<td id="ter10" onclick="content(this)"></td>
											<td id="ter11" onclick="content(this)"></td>
											<td id="ter12" onclick="content(this)"></td>
											<td id="ter13" onclick="content(this)"></td>
											<td id="ter14" onclick="content(this)"></td>
											<td id="ter15" onclick="content(this)"></td>
											<td id="ter16" onclick="content(this)"></td>
											<td id="ter17" onclick="content(this)"></td>
											<td id="ter18" onclick="content(this)"></td>
										</tr>

										<tr>
											<td>Quarta-Feira</td>
											<td id="qua8"  onclick="content(this)"></td>
											<td id="qua9"  onclick="content(this)"></td>
											<td id="qua10" onclick="content(this)"></td>
											<td id="qua11" onclick="content(this)"></td>
											<td id="qua12" onclick="content(this)"></td>
											<td id="qua13" onclick="content(this)"></td>
											<td id="qua14" onclick="content(this)"></td>
											<td id="qua15" onclick="content(this)"></td>
											<td id="qua16" onclick="content(this)"></td>
											<td id="qua17" onclick="content(this)"></td>
											<td id="qua18" onclick="content(this)"></td>
										</tr>

										<tr>
											<td>Quinta-Feira</td>
											<td id="qui8"  onclick="content(this)"></td>
											<td id="qui9"  onclick="content(this)"></td>
											<td id="qui10" onclick="content(this)"></td>
											<td id="qui11" onclick="content(this)"></td>
											<td id="qui12" onclick="content(this)"></td>
											<td id="qui13" onclick="content(this)"></td>
											<td id="qui14" onclick="content(this)"></td>
											<td id="qui15" onclick="content(this)"></td>
											<td id="qui16" onclick="content(this)"></td>
											<td id="qui17" onclick="content(this)"></td>
											<td id="qui18" onclick="content(this)"></td>
										</tr>

										<tr>
											<td>Sexta-Feira</td>
											<td id="sex8"  onclick="content(this)"></td>
											<td id="sex9"  onclick="content(this)"></td>
											<td id="sex10" onclick="content(this)"></td>
											<td id="sex11" onclick="content(this)"></td>
											<td id="sex12" onclick="content(this)"></td>
											<td id="sex13" onclick="content(this)"></td>
											<td id="sex14" onclick="content(this)"></td>
											<td id="sex15" onclick="content(this)"></td>
											<td id="sex16" onclick="content(this)"></td>
											<td id="sex17" onclick="content(this)"></td>
											<td id="sex18" onclick="content(this)"></td>
										</tr>


									</tbody>
								</table>

							
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
							<input hidden="true" name="iseg8"  id="iseg8"  value="0">
							<input hidden="true" name="iseg9"  id="iseg9"  value="0">
							<input hidden="true" name="iseg10" id="iseg10" value="0">
							<input hidden="true" name="iseg11" id="iseg11" value="0">
							<input hidden="true" name="iseg12" id="iseg12" value="0">
							<input hidden="true" name="iseg13" id="iseg13" value="0">
							<input hidden="true" name="iseg14" id="iseg14" value="0">
							<input hidden="true" name="iseg15" id="iseg15" value="0">
							<input hidden="true" name="iseg16" id="iseg16" value="0">
							<input hidden="true" name="iseg17" id="iseg17" value="0">
							<input hidden="true" name="iseg18" id="iseg18" value="0">

							<input hidden="true" name="iter8"  id="iter8"  value="0">
							<input hidden="true" name="iter9"  id="iter9"  value="0">
							<input hidden="true" name="iter10" id="iter10" value="0">
							<input hidden="true" name="iter11" id="iter11" value="0">
							<input hidden="true" name="iter12" id="iter12" value="0">
							<input hidden="true" name="iter13" id="iter13" value="0">
							<input hidden="true" name="iter14" id="iter14" value="0">
							<input hidden="true" name="iter15" id="iter15" value="0">
							<input hidden="true" name="iter16" id="iter16" value="0">
							<input hidden="true" name="iter17" id="iter17" value="0">
							<input hidden="true" name="iter18" id="iter18" value="0">

							<input hidden="true" name="iqua8"  id="iqua8"  value="0">
							<input hidden="true" name="iqua9"  id="iqua9"  value="0">
							<input hidden="true" name="iqua10" id="iqua10" value="0">
							<input hidden="true" name="iqua11" id="iqua11" value="0">
							<input hidden="true" name="iqua12" id="iqua12" value="0">
							<input hidden="true" name="iqua13" id="iqua13" value="0">
							<input hidden="true" name="iqua14" id="iqua14" value="0">
							<input hidden="true" name="iqua15" id="iqua15" value="0">
							<input hidden="true" name="iqua16" id="iqua16" value="0">
							<input hidden="true" name="iqua17" id="iqua17" value="0">
							<input hidden="true" name="iqua18" id="iqua18" value="0">

							<input hidden="true" name="iqui8"  id="iqui8"  value="0">
							<input hidden="true" name="iqui9"  id="iqui9"  value="0">
							<input hidden="true" name="iqui10" id="iqui10" value="0">
							<input hidden="true" name="iqui11" id="iqui11" value="0">
							<input hidden="true" name="iqui12" id="iqui12" value="0">
							<input hidden="true" name="iqui13" id="iqui13" value="0">
							<input hidden="true" name="iqui14" id="iqui14" value="0">
							<input hidden="true" name="iqui15" id="iqui15" value="0">
							<input hidden="true" name="iqui16" id="iqui16" value="0">
							<input hidden="true" name="iqui17" id="iqui17" value="0">
							<input hidden="true" name="iqui18" id="iqui18" value="0">

							<input hidden="true" name="isex8"  id="isex8"  value="0">
							<input hidden="true" name="isex9"  id="isex9"  value="0">
							<input hidden="true" name="isex10" id="isex10" value="0">
							<input hidden="true" name="isex11" id="isex11" value="0">
							<input hidden="true" name="isex12" id="isex12" value="0">
							<input hidden="true" name="isex13" id="isex13" value="0">
							<input hidden="true" name="isex14" id="isex14" value="0">
							<input hidden="true" name="isex15" id="isex15" value="0">
							<input hidden="true" name="isex16" id="isex16" value="0">
							<input hidden="true" name="isex17" id="isex17" value="0">
							<input hidden="true" name="isex18" id="isex18" value="0">
							
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
