<?php require_once ('application/views/medico/header.php')?>

<?php
    if (session_status() != PHP_SESSION_NONE) 
        echo "<p style='text-align:center; margin-top:30px; font-size:30px'>" . $this->session->userdata('nome') . "</p>";
?>

<?php
    $NOME_MESES = array(    1 => "Jan",
                            2 => "Fev",
                            3 => "Mar",
                            4 => "Abr",
                            5 => "Mai",
                            6 => "Jun",
                            7 => "Jul",
                            8 => "Ago",
                            9 => "Set",
                            10 => "Out",
                            11 => "Nov",
                            12 => "Dez");

    $datas = array();
    $consultas = array(array());

    foreach($query->result() as $row) {
        if(in_array($row->data, $datas) == false) {
            $datas[] = $row->data;
        }
        $consultas[$row->data][] = $row;
    }

?>

<?php $count = 0?>

<form name="form_receitar" id="form_receitar" onsubmit="return false;">
<?php foreach($datas as $data):
    $data_sepadada = explode("-", $data);
    $dia = $data_sepadada[2];
    $mes = $NOME_MESES[intval($data_sepadada[1])];
    $ano = $data_sepadada[0];
    $consultasNoDia = count($consultas[$data]) + 1;
?>

    <table>
        <tr class="coluna-titulo">
            <td rowspan="<?php echo $consultasNoDia?>"> <span class="letra-mes"><?php echo "$mes $dia"?></span> <br><?php echo $ano?></td>
        </tr>

        <?php foreach($consultas[$data] as $consulta):?>
            <tr>
                <td width=55%><b><?php echo $consulta->horario?></b><?php echo " - " . $consulta->nome_paciente .' - '.$consulta->nome_clinica?></td>
                <td><button class="btn btn-default botao" style="font-size: 10px" id="receitar<?php echo $count?>" onclick="toggleReceitar();">Receitar</button></td>    
                <td><button class="btn btn-default botao" style="font-size: 10px" id="diagnosticar<?php echo $count?>">Diagnosticar</button></td>
            </tr>

            <tr id="text_receita<?php echo $count?>" style="background-color: #FFFFFF;">
                <td colspan="5">
                    <textarea name="receita<?php echo $count?>" cols="60" rows="5" placeholder="Digite aqui a receita ou uma observação."></textarea>
                    <button type="submit" class="btn btn-default" id="btn_salvar_receita<?php echo $count?>" style="margin-bottom: 10px;" onclick="ajaxPost('../server/receitarPaciente.php', '#resultado-receita')">Salvar</button>
                </td>
            </tr>

            <tr id="text_diagnostico<?php echo $count?>" style="background-color: #FFFFFF;">
                <td colspan="5">
                    <textarea name="diagnostico<?php echo $count?>" cols="60" rows="5" placeholder="Digite aqui o diagnóstico do paciente."></textarea>
                    <button type="submit" class="btn btn-default" id="btn_salvar_diagnostico<?php echo $count?>" style="margin-bottom: 10px;" onclick="ajaxPost('../server/diagnosticarPaciente.php', '#resultado-diagnostico')">Salvar</button>
                </td>
            </tr>


            <script>
                function toggleReceitar() {
                    var x = document.getElementById("text_receita<?php echo $count?>");

                    if(x.style.display == "none")
                        x.style.display= '';
                    else
                        x.style.display = "none";
                }

                function toggleDiagnosticar() {
                    var x = document.getElementById("text_diagnostico<?php echo $count?>");

                    if(x.style.display == "none")
                        x.style.display = "block";
                    else
                        x.style.display = "none";
                }


                $(document).ready(function(){
                    $("#btn_salvar_receita<?php echo $count?>").click(function(){
                        $("#text_receita<?php echo $count?>").collapse("hide");
                    });

                    $("#btn_salvar_diagnostico<?php echo $count?>").click(function(){
                        $("#text_diagnostico<?php echo $count?>").collapse("hide");
                    });
                });

            </script>

        <?php $count += 1?>
        <?php endforeach?>

    </table>
<?php endforeach?>
<div id="resultado-receita"></div>
<div id="resultado-diagnostico"></div>

<?php require_once ('application/views/footer.php')?>