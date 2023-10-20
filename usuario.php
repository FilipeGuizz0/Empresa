<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');

if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$nome   = $_POST['nome'];
$login   = $_POST['login'];
$senha   = $_POST['senha'];
$status   = $_POST['status'];

$sql = "insert into usuarios (codigo,nome,login, senha, status)
        values ('$codigo','$nome','$login','$senha','$status')";

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
    $login   = $_POST['login'];
    $senha   = $_POST['senha'];
    $status   = $_POST['status'];


$sql = "update usuarios set nome = '$nome', login = '$login', senha = '$senha' , status = '$status'
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
    $login   = $_POST['login'];
    $senha   = $_POST['senha'];
    $status   = $_POST['status'];


$sql = "delete from usuarios where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from usuarios";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por usuarios "."<br>";
	while($usuarios = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$usuarios['codigo']."<br>".
                 "nome  : ".$usuarios['nome']."<br>".
                 "login  : ".$usuarios['login']."<br>".    
                 "senha  : ".$usuarios['senha']."<br>".
                 "status    : ".$usuarios['status']."<br><br>";
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
    <title>usuarios</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="usuario.php">
            <h1>Cadastro usuarios</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            nome:
            <input type="text" name="nome" id="nome" size=50>
            <br><br>
            login:
            <input type="text" name="login" id="login" size=50>
            <br><br>
            Senha:
            <input type="text" name="senha" id="senha" size=50>
            <br><br>
            <select id="status" name="status">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
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