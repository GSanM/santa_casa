<?php

require_once "atendente.php";
require_once "medico.php";

//$atendente = new Atendente();
$medico = new Medico();

//ATENDENTE

//$atendente->adicionaPaciente(12345678917, "'Antônio Nunes'", "'1955-06-06'", "''", "'Rua Ruim, 205'", 55533232992, "'huesdads'");
//$atendente->adicionaMedico(12553, 12321331231, "'Robervildo da Silva'", "'1985-12-06'", "'robervildo@gmail.com'", "'Rua Boa, 175'", 555332312321, "'Odontologista'", "'huesadue'");
//$atendente->adicionaConsulta(12553, 12345678916, "'12:00'", "'2018-10-15'", 1234566);
//$atendente->deletaConsulta(1);
//$atendente->deletaPaciente(12345678912);
//$atendente->alteraMedico(12552, 12321331232, '"Robervaldo da Silva"', '"1985-11-06"', '"robervaldo@gmail.com"', '"Rua Boa, 175"', '"555332312321"', '"Odontologista"', '"huesadue"', 9923992293);

//MEDICO
$medico->veAgenda(12553);

?>