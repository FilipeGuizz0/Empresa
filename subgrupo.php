<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_banco       = "SELECT codigo, descricao FROM grupo ";
$pesquisar_banco = mysql_query($sql_banco);


if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$descricao   = $_POST['descricao'];
$codgrupo   = $_POST['codgrupo'];

$sql = "insert into subgrupo (codigo,descricao, codgrupo)
        values ('$codigo','$descricao','$codgrupo')";


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
    $codgrupo   = $_POST['codgrupo'];
    

$sql = "update subgrupo set descricao = '$descricao'
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
$codgrupo   = $_POST['codgrupo'];

$sql = "delete from subgrupo where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from subgrupo";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por subgrupo "."<br>";
	while($subgrupo = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$subgrupo['codigo']."<br>".
                 "descricao    : ".$subgrupo['descricao']."<br>".
                 "codgrupo: ".$subgrupo['codgrupo']."<br><br>";
                 ;
			}
}

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="box.css">
    <title>subgrupo</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="subgrupo.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            descricao:
            <input type="text" name="descricao" id="descricao" size=50>
            <br><br>
            Grupo: <select name="codgrupo" id="codgrupo">
                              <option value=0 selected="selected">Selecione o grupo ...</option>
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