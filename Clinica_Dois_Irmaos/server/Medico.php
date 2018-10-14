<!DOCTYPE html>
<html>
<head>
    <title> Classe Medico </title>
</head>
<body>
    <?php
    
    require_once "AbsPessoa.php";
  
    class Medico extends AbsPessoa {
        public $crm;
        public $especialidade;
        
        public $inicio_expediente_seg;
        public $fim_expediente_seg;

        public $inicio_expediente_ter;
        public $fim_expediente_ter;

        public $inicio_expediente_qua;
        public $fim_expediente_qua;

        public $inicio_expediente_qui;
        public $fim_expediente_qui;

        public $inicio_expediente_sex;
        public $fim_expediente_sex;

        public function Medico($novo_cpf, $nova_senha) {
            $this->cpf = $novo_cpf;
            $this->senha = $nova_senha;
        }
        
        public function getCPF() {
            return $this->cpf;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function verAgenda() {
            
        }

    }
    

    ?>
</body>
</html>