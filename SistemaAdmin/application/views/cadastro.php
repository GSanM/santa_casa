<?php require_once 'header.php'?>
    <div class="base-home">
        <h1 class="titulo">>> CADASTRAR UMA NOVA CLINICA</h1>
        
        <div class='formulario'>
            <?php 
                
                echo validation_errors('<div class="alerta">','</div>');
                echo "<br>";

                $atributosForm = array('name' => 'formulario_cadastro', 'id'=> 'formulario_cadastro');
                echo form_open(base_url('cadastro/cadastrar_clinica'), $atributosForm);
            ?>
                
                <div>
                    <label for="txtNomeClinica">Nome da Clinica</label>
                    <input type="text" name="txtNomeClinica" value="<?php echo set_value('txtNomeClinica')?>" id="txtNomeClinica" placeholder="Digite o nome da nova Clinica"  />
                </div>
                <br>
                
                <div>
                    <label for="txtNomeClinica">Nome do Gerente</label>
                    <input type="text" name="txtNomeGerente" value="<?php echo set_value('txtNomeGerente')?>" id="txtNomeGerente" placeholder="Digite o nome do Gerente Responsável"  />
                </div>
                <br>
                
                <div>
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" value="<?php echo set_value('cnpj')?>" id="cnpj" placeholder="Digite o CNPJ da Clinica"  />
                </div>
                <br>

                <div>
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" value="<?php echo set_value('endereco')?>" id="endereco" placeholder="Digite o Endereço"  />
                </div>
                <br>

                <div>
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" value="<?php echo set_value('telefone')?>" id="telefone" placeholder="Digite o Telefone" />
                <br>
                <br>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar Clinica</button>  
            
            <?php
                echo form_close();
            ?>
        </div>

    </div>
    
<?php require_once 'footer.php'?>