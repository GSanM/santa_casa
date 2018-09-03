<!DOCTYPE html>
<html>
<head>
    <title> Classe Paciente </title>
</head>
<body>
    <?php

        require_once "AbsPessoa.php";
        
        class Paciente extends AbsPessoa {
            
            public function Paciente($novo_cpf, $nova_senha) {
                $this->cpf = $novo_cpf;
                $this->senha = $nova_senha;
            }
            
            public function getCPF() {
                return $this->cpf;
            }

            public function getSenha() {
                return $this->senha;
            }
        }


    ?>
</body>
</html>