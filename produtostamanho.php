<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_produtos       = "SELECT codigo, descricao FROM produtos ";
$pesquisar_produtos = mysql_query($sql_produtos);

$sql_tamanhos       = "SELECT codigo, tamanhos FROM tamanhos ";
$pesquisar_tamanhos = mysql_query($sql_tamanhos);


if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$precovenda = $_POST['precovenda'];
$precocompra   = $_POST['precocompra'];
$quantidadeatual   = $_POST['quantidadeatual'];
$quantidadeinicial   = $_POST['quantidadeinicial'];
$codproduto   = $_POST['codproduto'];
$codtamanho   = $_POST['codtamanho'];


$sql = "insert into produtostamanho (codigo,precovenda,precocompra, quantidadeatual, quantidadeinicial, codproduto, codtamanho)
        values ('$codigo','$precovenda','$precocompra', '$quantidadeatual', '$quantidadeinicial', '$codproduto', '$codtamanho')";


$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados gravados com sucesso."; }
else
{  echo "Erro ao gravar os dados."; }
}


if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $precovenda = $_POST['precovenda'];
    $precocompra   = $_POST['precocompra'];
    $quantidadeatual   = $_POST['quantidadeatual'];
    $quantidadeinicial   = $_POST['quantidadeinicial'];
    $codproduto   = $_POST['codproduto'];
    $codtamanho   = $_POST['codtamanho'];

    $sql = "UPDATE produtostamanho SET precovenda = '$precovenda', quantidadeatual = '$quantidadeatual'
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
    $precovenda = $_POST['precovenda'];
    $precocompra   = $_POST['precocompra'];
    $quantidadeatual   = $_POST['quantidadeatual'];
    $quantidadeinicial   = $_POST['quantidadeinicial'];
    $codproduto   = $_POST['codproduto'];
    $codtamanho   = $_POST['codtamanho'];


$sql = "delete from produtostamanho where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}



if (isset($_POST['pesquisar']))
{
$sql = "select * from produtostamanho";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por produtostamanho "."<br>";
	while($produtostamanho = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$produtostamanho['codigo']."<br>".
                 "precovenda    : ".$produtostamanho['precovenda']."<br>".
                 "precocompra    : ".$produtostamanho['precocompra']."<br>".
                 "quantidadeatual   : ".$produtostamanho['quantidadeatual']."<br>".
                 "quantidadeinicial: ".$produtostamanho['quantidadeinicial']."<br>".
                 "codproduto: ".$produtostamanho['codproduto']."<br>".
                 "codtamanho: ".$produtostamanho['codtamanho']."<br><br>";
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
    <title>produtostamanho</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="produtostamanho.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            preço venda:
            <input type="number" name="precovenda" id="precovenda" size=50>
            <br><br>
            preço compra:
            <input type="number" name="precocompra" id="precocompra" size=50>
            <br><br>
            Quantidade atual:
            <input type="number" name="quantidadeatual" id="quantidadeatual" size=50>
            <br><br>
            Quantidade inicial:
            <input type="number" name="quantidadeinicial" id="quantidadeinical" size=50>
            <br><br>
            tamanho: <select name="codtamanho" id="codtamanho">
                              <option value=0 selected="selected">Selecione o tamanho ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_tamanhos) == 0)
                                {
                                echo '<h1>Sua busca por banco não retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_tamanhos))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['tamanhos']).'</option>';
                                }
                                }
                                ?>
                              </select>
            <br><br>
            Produtos: <select name="codproduto" id="codproduto">
                              <option value=0 selected="selected">Selecione o produto...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_produtos) == 0)
                                {
                                echo '<h1>Sua busca por produtos não retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_produtos))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['descricao']).'</option>';
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
