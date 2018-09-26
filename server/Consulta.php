<!DOCTYPE html>
<html>
<head>
    <title> Classe Consulta </title>
</head>
<body>
    <?php
        class Consulta {
            public $nome_paciente;
            public $nome_medico;
            public $horario;
            public $receita;
            public $data;
            public $dia;
            public $mes;
            public $ano;
            public $diagnostico;

            function __construct($nome_paciente, $nome_medico, $data, $horario) {
                $this->nome_paciente = $nome_paciente;
                $this->nome_medico = $nome_medico;
                $this->data = $data;

                $splits = explode("-", $data);
                $this->ano = $splits[0];
                $this->mes = $splits[1];
                $this->dia = $splits[2];

                $this->horario = $horario;
            }

        }

    ?>
</body>
</html>