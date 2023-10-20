<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');

if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$descricao   = $_POST['descricao'];

$sql = "insert into colecao (codigo,descricao)
        values ('$codigo','$descricao')";

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


$sql = "update colecao set descricao = '$descricao'
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


$sql = "delete from colecao where codigo = '$codigo'";

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
    <title>colecao</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="colecao.php">
            <h1>Cadastro colecao</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            Descrição:
            <input type="text" name="descricao" id="descricao" size=50>
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
            $sql = "select * from colecao";
            $resultado = mysql_query($sql);
        
            if (mysql_num_rows($resultado) == 0) {
                echo "Sua pesquisa não retornou resultados ";
            } else {
                echo "<h2>Resultado da Pesquisa por colecaos</h2>";
                echo "<table id='result-table' align='center' border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
                echo "<tr style='background-color: #469bd2; color: white;'>";
                echo "<th>Código</th><th>descricao</th>";
                echo "</tr>";
                while ($colecao = mysql_fetch_array($resultado)) {
                    echo "<tr>";
                    echo "<td>".$colecao['codigo']."</td>";
                    echo "<td>".$colecao['descricao']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </div>
</body>
</html>