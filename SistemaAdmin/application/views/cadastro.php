<?php require_once 'header.php'?>
    <div class="base-home">
        <h1 class="titulo">>> CADASTRAR UMA NOVA CLINICA</h1>
        
        <?php 
            
            echo "<div class='formulario'>";

            echo validation_errors('<div class="alerta">','</div>');
            echo "<br>";

            $atributosForm = array('name' => 'formulario_cadastro', 'id'=> 'formulario_cadastro');
            echo form_open(base_url('cadastro/cadastrar_clinica'), $atributosForm);

            $atribNomeClinica= array('name'=>'txtNomeClinica','id'=>'txtNomeClinica','placeholder'=>'Digite o nome da nova Clinica', 'value' => set_value('txtNomeClinica'));
            echo("<div>").
            form_label("Nome da Clinica",'txtNomeClinica').
            form_input($atribNomeClinica).
            ("</div>");
            echo "<br>";

            $atribNomeGerente= array('name'=>'txtNomeGerente','id'=>'txtNomeGerente','placeholder'=>'Digite o nome do Gerente Responsável', 'value' => set_value('txtNomeGerente'));
            echo("<div>").
            form_label("Nome do Gerente",'txtNomeClinica').
            form_input($atribNomeGerente).
            ("</div>");
            echo "<br>";

            $atribGerenteCPF= array('name'=>'cpfGerente','id'=>'cpfGerente','placeholder'=>'Digite o CPF do Gerente', 'value' => set_value('cpfGerente'));
            echo("<div>").
            form_label("CPF",'cpfGerente').
            form_input($atribGerenteCPF).
            ("</div>");


            echo "<br><br>";

            echo "<div id='btnSubmit'>";
            echo form_submit('btn_cadastrar','Cadastrar Clinica');
            echo "</div>";

            echo form_close();

            echo "</div>";


        ?>

    </div>
    
<?php require_once 'footer.php'?>