<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_banco       = "SELECT codigo, nome FROM banco ";
$pesquisar_banco = mysql_query($sql_banco);


if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$descricao   = $_POST['descricao'];
$saldoinicial   = $_POST['saldoinicial'];
$saldoatual   = $_POST['saldoatual'];
$agencia   = $_POST['agencia'];
$digitoagencia   = $_POST['digitoagencia'];
$digito   = $_POST['digito'];
$codbanco   = $_POST['codbanco'];

$sql = "insert into contacorrente (codigo,descricao,saldoinicial, saldoatual, agencia, digitoagencia, digito, codbanco)
        values ('$codigo','$descricao','$saldoinicial', '$saldoatual', '$agencia', '$digitoagencia', '$digito', '$codbanco')";


$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados gravados com sucesso."; }
else
{  echo "Erro ao gravar os dados."; }
}


if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $saldoinicial   = $_POST['saldoinicial'];
    $saldoatual   = $_POST['saldoatual'];
    $agencia   = $_POST['agencia'];
    $digitoagencia   = $_POST['digitoagencia'];
    $digito   = $_POST['digito'];
    $codbanco   = $_POST['codbanco'];

$sql = "update contacorrente set descricao = '$descricao'
        where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados alterados com sucesso."; }
else
{  echo "Erro ao alterar os dados."; }
}


if (isset($_POST['excluir']))
{
$codigo = $_POST['codigo'];
$descricao   = $_POST['descricao'];
$saldoinicial   = $_POST['saldoinicial'];
$saldoatual   = $_POST['saldoatual'];
$agencia   = $_POST['agencia'];
$digitoagencia   = $_POST['digitoagencia'];
$digito   = $_POST['digito'];
$codbanco   = $_POST['codbanco'];

$sql = "delete from contacorrente where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}




?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="box.css">
    <meta charset="UTF-8">
    <title>Contacorrente</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="contacorrente.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            descricao:
            <input type="text" name="descricao" id="descricao" size=50>
            <br><br>
            Saldo Inicial:
            <input type="number" name="saldoinicial" id="saldoinicial" size=50>
            <br><br>
            Saldo Atual:
            <input type="number" name="saldoatual" id="saldoatual" size=50>
            <br><br>
            Agencia:
            <input type="text" name="agencia" id="agencia" size=50>
            <br><br>
            Digito Agencia:
            <input type="text" name="digitoagencia" id="digitoagencia" size=50>
            <br><br>
            Digito:
            <input type="text" name="digito" id="digito" size=50>
            <br><br>
            banco: <select name="codbanco" id="codbanco">
                              <option value=0 selected="selected">Selecione categoria ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_banco) == 0)
                                {
                                echo '<h1>Sua busca por banco n�o retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_banco))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                                ?>
                              </select>
            <br><br>
            <input type="submit" name="gravar"    id="gravar"    value="Gravar">
            <input type="submit" name="alterar"   id="alterar"   value="Alterar">
            <input type="submit" name="excluir"   id="excluir"   value="Excluir">
            <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
            
            <br><br>
            <a href="Home.html">Voltar</a>
        </form>
        <?php
if (isset($_POST['pesquisar'])) {
    $sql = "select * from contacorrente";
    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0) {
        echo "Sua pesquisa não retornou resultados ";
    } else {
        echo "<h2>Resultado da Pesquisa por contacorrentes</h2>";
        echo "<table id='result-table' align='center' border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
        echo "<tr style='background-color: #469bd2; color: white;'>";
        echo "<th>Código</th><th>Descrição</th><th>Saldo Inicial</th><th>Saldo Atual</th><th>Nome</th><th>Nome</th>";
        echo "</tr>";
        while ($contacorrente = mysql_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>".$contacorrente['codigo']."</td>";
            echo "<td>".$contacorrente['nome']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>
    </div>
</body>
</html>