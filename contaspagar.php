<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_banco       = "SELECT codigo, nome FROM pessoa ";
$pesquisar_banco = mysql_query($sql_banco);


if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$parcela   = $_POST['parcela'];
$valor   = $_POST['valor'];
$status   = $_POST['status'];
$vencimento   = $_POST['vencimento'];
$dataconta   = $_POST['dataconta'];
$codpessoa   = $_POST['codpessoa'];

$sql = "insert into contapagar (codigo,parcela,valor, status, vencimento, dataconta, codpessoa)
        values ('$codigo','$parcela','$valor', '$status', '$vencimento', '$dataconta', '$codpessoa')";


$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados gravados com sucesso."; }
else
{  echo "Erro ao gravar os dados."; }
}


if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $parcela   = $_POST['parcela'];
    $valor   = $_POST['valor'];
    $status   = $_POST['status'];
    $vencimento   = $_POST['vencimento'];
    $dataconta   = $_POST['dataconta'];
    $codpessoa   = $_POST['codpessoa'];

    $sql = "UPDATE contapagar SET parcela = '$parcela', valor = '$valor', status = '$status'
    WHERE codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados alterados com sucesso."; }
else
{  echo "Erro ao alterar os dados."; }
}


if (isset($_POST['excluir']))
{
$codigo = $_POST['codigo'];
$parcela   = $_POST['parcela'];
$valor   = $_POST['valor'];
$status   = $_POST['status'];
$vencimento   = $_POST['vencimento'];
$dataconta   = $_POST['dataconta'];
$codpessoa   = $_POST['codpessoa'];


$sql = "delete from contapagar where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from contapagar";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por contapagar "."<br>";
	while($contapagar = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$contapagar['codigo']."<br>".
                 "parcela    : ".$contapagar['parcela']."<br>".
                 "valor    : ".$contapagar['valor']."<br>".
                 "Status   : ".$contapagar['status']."<br>".
                 "vencimento: ".$contapagar['vencimento']."<br>".
                 "Data Conta: ".$contapagar['dataconta']."<br>".
                 "codpessoa: ".$contapagar['codpessoa']."<br><br>";
                 ;
			}
}

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="box.css">
    <meta charset="UTF-8">
    <title>contapagar</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="contaspagar.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            Parcela:
            <input type="number" name="parcela" id="parcela" size=50>
            <br><br>
            Valor:
            <input type="number" name="valor" id="valor" size=50>
            <br><br>
            Status:
            <select id="status" name="status">
                <option value="Aberta">Aberta</option>
                <option value="Paga">Paga</option>
                <option value="Vencida">Vencida</option>
            </select>
            <br><br>
            Vencimento:
            <input type="date" name="vencimento" id="vencimento" size=50>
            <br><br>
            Data da Conta:
            <input type="date" name="dataconta" id="dataconta" size=50>
            <br><br>
            Pessoa: <select name="codpessoa" id="codpessoa">
                              <option value=0 selected="selected">Selecione a pessoa ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_banco) == 0)
                                {
                                echo '<h1>Sua busca por banco não retornou resultados ... </h1>';
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
    </div>
</body>
</html>