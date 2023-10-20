<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');

if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$nome   = $_POST['nome'];
$descricao   = $_POST['descricao'];

$sql = "insert into marca (codigo,nome,descricao)
        values ('$codigo','$nome','$descricao')";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "Dados gravados com sucesso."; }
else
{  echo "Erro ao gravar os dados."; }
}


if (isset($_POST['alterar']))
{
$codigo = $_POST['codigo'];
$nome   = $_POST['nome'];
$descricao   = $_POST['descricao'];

$sql = "update marca set nome = '$nome'
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
$nome   = $_POST['nome'];
$descricao   = $_POST['descricao'];

$sql = "delete from marca where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from marca";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por Marcas "."<br>";
	while($marca = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$marca['codigo']."<br>".
                 "Nome    : ".$marca['nome']."<br>".
                 "descricao    : ".$marca['descricao']."<br><br>";
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
    <title>Marca</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="marca.php">
            <h1>Cadastro Marca</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            nome:
            <input type="text" name="nome" id="nome" size=50>
            <br><br>
            descricao:
            <input type="text" name="descricao" id="descricao" size=50>
            
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