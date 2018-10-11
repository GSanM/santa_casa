<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <script src="horario.js"></script>
</head>
<body>
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

<form action="gravarHorarioMedico.php" method="POST">
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

    <button type="submit" >Enviar</button>
</form>

</body>
</html>