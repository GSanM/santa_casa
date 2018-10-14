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

        <!------------------------- CSS ------------------------->
		<link rel="stylesheet" type="text/css" media="screen" href="css/paciente.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/reveal.css">	
        <!--====================================================-->
        
        <!------------------------- FONTES ------------------------->
		<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Amatic+SC|Archivo+Narrow|Exo|Anton|Josefin+Sans|Lobster" rel="stylesheet">
		<!--====================================================-->

        <!------------------------- JS ------------------------->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script type="text/javascript"> var jQuery_3_3_1 = $.noConflict(true); </script>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script type="text/javascript"> var jQuery_1_6 = $.noConflict(true); </script>

        <script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.reveal.js"></script>
		<script src="js/paciente.js"></script>
		<script src="js/atendente.js"></script>
        <script type="text/javascript" src="js/post.js"></script>
        
        <!--====================================================-->

    </head>
    <body>
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

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnAgendar" onclick="ajaxPost('../server/agendarPendente.php', '#result-agendar')">Agendar</button>
							</div>
						</form>


						<!--Horário-->
						<div class="collapse" id="med-disp">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
								<input id="appointment_hour" name="appointment_hour" class="form-control" type="time" required>
							</div>

							<div class="submit-button" id="submit-agenda">
								<button type="submit" class="btn btn-default" id="btnAgendar" onclick="ajaxPost('../server/agendarPendente.php', '#result-agendar')">Agendar</button>
							</div>
						</div>
						
						<div id="result-agendar"></div>
		<a href="#" class="big-link" data-reveal-id="myModal" data-animation="fade">
			
		</a>


		<div id="myModal" class="reveal-modal">
			<h1>Reveal Modal Goodness</h1>
			<p>This is a default modal in all its glory, but any of the styles here can easily be changed in the CSS.</p>
			<a class="close-reveal-modal">&#215;</a>
		</div>
			
	</body>
</html>