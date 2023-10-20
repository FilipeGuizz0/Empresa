<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_contareceber = "SELECT codigo FROM contareceber";
$pesquisar_contareceber = mysql_query($sql_contareceber);

$sql_contapagar = "SELECT codigo FROM contapagar";
$pesquisar_contapagar = mysql_query($sql_contapagar);

$sql_parcela = "SELECT codigo, parcela FROM parcela";
$pesquisar_parcela = mysql_query($sql_parcela);

$sql_parcelapagar = "SELECT codigo, parcela FROM parcela";
$pesquisar_parcelapagar = mysql_query($sql_parcelapagar);


if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$valor   = $_POST['valor'];
$datamovimento   = $_POST['datamovimento'];
$juros   = $_POST['juros'];
$total   = $_POST['total'];
$codcontareceber   = $_POST['codcontareceber'];
$codparcelareceber   = $_POST['codparcelareceber'];
$codcontapagar   = $_POST['codcontapagar'];
$codparcelapagar   = $_POST['codparcelapagar'];


$sql = "insert into movimento (codigo,valor,datamovimento, juros, total, codcontareceber, codparcelareceber, codcontapagar, codparcelapagar)
        values ('$codigo','$valor','$datamovimento', '$juros', '$total', '$codcontareceber', '$codparcelareceber', '$codcontapagar','$codparcelapagar')";


$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados gravados com sucesso."; }
else
{  echo "Erro ao gravar os dados."; }
}


if (isset($_POST['alterar']))
{

    $codigo = $_POST['codigo'];
    $valor   = $_POST['valor'];
    $datamovimento   = $_POST['datamovimento'];
    $juros   = $_POST['juros'];
    $total   = $_POST['total'];
    $codcontareceber   = $_POST['codcontareceber'];
    $codparcelareceber   = $_POST['codparcelareceber'];
    $codcontapagar   = $_POST['codcontapagar'];
    $codparcelapagar   = $_POST['codparcelapagar'];

    $sql = "UPDATE movimento SET valor = '$valor', juros = '$juros', total = '$total',datamovimento = '$datamovimento'
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
    $valor   = $_POST['valor'];
    $datamovimento   = $_POST['datamovimento'];
    $juros   = $_POST['juros'];
    $total   = $_POST['total'];
    $codcontareceber   = $_POST['codcontareceber'];
    $codparcelareceber   = $_POST['codparcelareceber'];
    $codcontapagar   = $_POST['codcontapagar'];
    $codparcelapagar   = $_POST['codparcelapagar'];

$sql = "delete from movimento where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from movimento";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por movimento "."<br>";
	while($movimento = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$movimento['codigo']."<br>".
                 "valor    : ".$movimento['valor']."<br>".
                 "Movimento    : ".$movimento['datamovimento']."<br>".
                 "juros   : ".$movimento['juros']."<br>".
                 "total: ".$movimento['total']."<br>".
                 "codcontareceber: ".$movimento['codcontareceber']."<br>".
                 "codparcelareceber: ".$movimento['codparcelarecber']."<br>".
                 "codcontapagar: ".$movimento['codcontapagar']."<br>".
                 "codparcelapagar: ".$movimento['codcontapagar']."<br><br>";
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
    <title>movimento</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="movimento.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50><br><br>
            data movimento:
            <input type="date" name="datamovimento" id="datamovimento" size=50><br><br>
            valor:
            <input type="number" name="valor" id="valor" size=50><br><br>
            juros:
            <input type="number" name="juros" id="juros" size=50><br><br>
            total:
            <input type="number" name="total" id="total" size=50> 
            <br><br>
            conta pagar: <select name="codcontareceber" id="codcontareceber">
                              <option value=0 selected="selected">Selecione codigo ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_contareceber) == 0)
                                {
                                echo '<h1>Sua busca por contareceber nao retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_contareceber))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['codigo']).'</option>';
                                }
                                }
                                ?>
                              </select>
            <br><br>
            parcela: <select name="codparcelareceber" id="codparcelareceber">
                              <option value=0 selected="selected">Selecione codigo ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_parcela) == 0)
                                {
                                echo '<h1>Sua busca por parcela nao retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_parcela))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['parcela']).'</option>';
                                }
                                }
                                ?>
                              </select>
            <br><br>
            
            conta pagar: <select name="codcontapagar" id="codcontapagar">
                              <option value=0 selected="selected">Selecione codigo ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_contapagar) == 0)
                                {
                                echo '<h1>Sua busca por contapagar nao retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_contapagar))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['codigo']).'</option>';
                                }
                                }
                                ?>
                              </select>
            <br><br>
            parcela: <select name="codparcelapagar" id="codparcelapagar">
                              <option value=0 selected="selected">Selecione codigo ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_parcelapagar) == 0)
                                {
                                echo '<h1>Sua busca por parcela nao retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_parcelapagar))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['parcela']).'</option>';
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