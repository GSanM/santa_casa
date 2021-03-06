<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	$columnsToBeSelected = "medico.nome AS nome_medico, clinica.nome AS nome_clinica, especialidade";
	$join1               = "medico JOIN medico_clinica ON medico.crm = medico_clinica.crm_medico";
	$join2               = "JOIN clinica ON clinica.cnpj = medico_clinica.cnpj_clinica";
	$query = "SELECT $columnsToBeSelected FROM $join1 $join2";

	$search_result = filterTable($query);


	function filterTable($query)
	{
		$connect = mysqli_connect("localhost", "root", "Dijkstra", "clinical_system");
		$filter_Result = mysqli_query($connect, $query);

		if($filter_Result)
			return $filter_Result;
		else
			die(mysqli_error($connect));
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Santa Casa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="media/Icons/png/asterisk.png">

		<link rel="stylesheet" type="text/css" media="screen" href="css/paciente.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />

		<!--Fontes-->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Amatic+SC|Archivo+Narrow|Exo|Anton|Josefin+Sans|Lobster" rel="stylesheet">
		<!--======-->

		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/paciente.js"></script>
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
				<img src="media/Icons/png/blood-drop.png" width="5%">
				<?php
					echo "<h1>";
                    echo ((date('H')) >= 3 && (date('H')) < 9) ? "Boa Madrugada, " : "";
                    echo ((date('H')) >= 9 && (date('H')) < 15) ? "Bom Dia, " : "";
                    echo ((date('H')) >= 15 && (date('H')) < 21) ? "Boa Tarde, " : "";
					echo ((date('H')) >= 21 || (date('H')) < 3) ? "Boa Noite, " : "";
					
					
					echo "Sr(a). " . $_SESSION['nome'] . "</h1><br><br>";
                ?>
			</div>
			
			<div>
		
				<div class="btn-group"  id="root-buttons">
					<button id="ver-perfil" class="btn btn-default"><i class="glyphicon glyphicon-user"></i> Perfil</button>
					<button class="btn btn-default" id="agendar"><i class="glyphicon glyphicon-calendar"></i> Agendar</button>
					<button class="btn btn-default" id="minhas-consultas" onclick="ajaxPost('../model/agendaPaciente.php', '#result-historico')"><i class="glyphicon glyphicon-book"></i> Minhas Consultas</button>
					<button class="btn btn-default" id="sair" onclick="ajaxPost('../server/sair.php', sair())"><i class="glyphicon glyphicon-log-out"></i> Sair</button>
				</div>

				<!--Perfil-->
				<div class="collapse" id="perfil">
					<form name="form_cadastro" id="form_cadastro" onsubmit="return false;">
						<div class="border">
							<div class="header-perfil">
								<br><br>
									<img src="media/Icons/png/appointment-book.png" width="8%">

									<h1 id="h1-paciente"> Meu Perfil </h1>
							</div>
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

							<div class="submit-button">
								<button type="submit" class="btn btn-default" id="btnCadastrar" onclick="ajaxPost('../server/alterarCadastroPaciente.php', '#resultado-alterar-cadastro')">Salvar</button>
							</div>
							<div id="resultado-alterar-cadastro"></div>
						</div>
					</form>
				</div>

				<!--Agendar-->
				<div class="collapse" id="agendar-div">
					<div class="border">
						<h2>Agendar Consulta</h2>
						
						<input class="form-control" id="myInput" type="text" placeholder="Filtrar..">
						<br>
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>Nome do Médico</th>
								<th>Especialidade</th>
								<th>Nome da Clinica</th>
							</tr>
							</thead>
							<tbody id="myTable">
							<?php while($row = mysqli_fetch_array($search_result)):?>
										<tr class="dialog" class="clickable">
											<td><?php echo $row['nome_medico'];?></td>
											<td><?php echo $row['especialidade'];?></td>
											<td><?php echo $row['nome_clinica'];?></td>
										</tr>
							<?php endwhile;?>

							</tbody>
						</table>
						
						
						<form name="form_agendar" id="form_agendar" onsubmit="return false;">

							<div class="collapse">
								<input id="patient-name" class="form-control" type="text" name="patient-name" placeholder="Nome do Paciente" value="<?php echo $_SESSION['nome'];?>" required>
							</div>

							<!--Nome Médico-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
								<input list="doctors" id="med-name" class="form-control" type="text" name="med-name" placeholder="Nome do Médico" required>
								<?php
									require_once "../model/getMedicos.php";
								?>
							</div>

							<!--Horário-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
								<input id="appointment_day" name="appointment_day" class="form-control" type="date" required>
								<input id="appointment_hour" name="appointment_hour" class="form-control" type="time" required>
							</div>

							<!--Clïnica-->
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-plus-sign"></i></span>
								<input list="clinicas" id="clinica" class="form-control" type="text" name="clinica" placeholder="Nome da Clínica" required>
								<?php
									require_once "../model/getClinicas.php";
								?>
							</div>

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnAgendar" onclick="ajaxPost('../server/agendarPendente.php', '#result-agendar')">Agendar</button>
							</div>

						</form>	

						<div id="result-agendar"></div>
					</div>
				</div>

				<!--Histórico-->
				<div class="collapse" id="minhas-consultas-div">
					<div class="border">
						<form id="form_historico" onsubmit="return false;">
							<div class="collapse">
								<input id="patient-name-ver-agenda" class="form-control" type="text" name="patient-name-ver-agenda" placeholder="Nome do Paciente" value="<?php echo $_SESSION['nome'];?>" required>
							</div>
						</form>
						<div id="result-historico"></div>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>
