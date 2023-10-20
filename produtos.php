<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_colecao       = "SELECT codigo, descricao FROM colecao ";
$pesquisar_colecao = mysql_query($sql_colecao);

$sql_marca       = "SELECT codigo, nome FROM marca ";
$pesquisar_marca = mysql_query($sql_marca);

$sql_subgrupo       = "SELECT codigo, descricao FROM subgrupo ";
$pesquisar_subgrupo = mysql_query($sql_subgrupo);



if (isset($_POST['gravar']))
{
//receber as variaveis do HTML
$codigo = $_POST['codigo'];
$descricao   = $_POST['descricao'];
$codsubgrupo   = $_POST['codsubgrupo'];
$codmarca   = $_POST['codmarca'];
$codcolecao   = $_POST['codcolecao'];

$sql = "insert into produtos (codigo, descricao, codsubgrupo, codmarca, codcolecao)
        values ('$codigo','$descricao', '$codsubgrupo', '$codmarca', '$codcolecao')";

                        
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
    $codsubgrupo   = $_POST['codsubgrupo'];
    $codmarca   = $_POST['codmarca'];
    $codcolecao   = $_POST['codcolecao'];

    $sql = "UPDATE produtos SET descricao = '$descricao', codcolecao = '$codcolecao', codmarca = '$codmarca', codsubgrupo = '$codsubgrupo'
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
$descricao   = $_POST['descricao'];
$codsubgrupo   = $_POST['codsubgrupo'];
$codmarca   = $_POST['codmarca'];
$codcolecao   = $_POST['codcolecao'];


$sql = "delete from produtos where codigo = '$codigo'";

$resultado = mysql_query($sql);
if ($resultado)
{  echo "dados excluidos com sucesso."; }
else
{  echo "erro ao excluir os dados."; }
}


if (isset($_POST['pesquisar']))
{
$sql = "select * from produtos";

$resultado = mysql_query($sql);

if (mysql_num_rows($resultado) == 0)
{ echo "Sua pesquisa nao retornou resultados "; 		}
else
{
	echo "Resultado da Pesquisa por produtos "."<br>";
	while($produtos = mysql_fetch_array($resultado))
			{
			echo "Codigo  : ".$produtos['codigo']."<br>".
                 "descricao    : ".$produtos['descricao']."<br>".
                 "codsubgrupo: ".$produtos['codsubgrupo']."<br>".
                 "Cod marca: ".$produtos['codmarca']."<br>".
                 "codcolecao: ".$produtos['codcolecao']."<br><br>";
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
    <title>produtos</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="produtos.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            Descrição:
            <input type="text" name="descricao" id="descricao" size=50>
            <br><br>
            
            Coleção: <select name="codcolecao" id="codcolecao">
                              <option value=0 selected="selected">Selecione a Colecao ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_colecao) == 0)
                                {
                                echo '<h1>Sua busca por colecao não retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_colecao))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['descricao']).'</option>';
                                }
                                }
                                ?>
                              </select>
            
                              <button id="openPopup">Cadastrar</button>
            <br><br>
            Marca: <select name="codmarca" id="codmarca">
                              <option value=0 selected="selected">Selecione a Marca ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_marca) == 0)
                                {
                                echo '<h1>Sua busca por marca não retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_marca))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['nome']).'</option>';
                                }
                                }
                                ?>
                              </select>
                              <button id="openPopup2">Cadastrar</button>
            <br><br>
            subgrupo: <select name="codsubgrupo" id="codsubgrupo">
                              <option value=0 selected="selected">Selecione a subgrupo ...</option>
                              <?php
                                if(mysql_num_rows($pesquisar_subgrupo) == 0)
                                {
                                echo '<h1>Sua busca por subgrupo não retornou resultados ... </h1>';
                                }
                                else
                                {
                                while($resultado = mysql_fetch_array($pesquisar_subgrupo))
                                {
                                    echo '<option value="'.$resultado['codigo'].'">'.
                                                utf8_encode($resultado['descricao']).'</option>';
                                }
                                }
                                ?>
                              </select>
                              <button id="openPopup3">Cadastrar</button>
            <br><br>
            <input type="submit" name="gravar"    id="gravar"    value="Gravar">
            <input type="submit" name="alterar"   id="alterar"   value="Alterar">
            <input type="submit" name="excluir"   id="excluir"   value="Excluir">
            <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
            <br><br>
            <a href="Home.html">Voltar</a>
        </form>
    </div>
    
    <script>
    document.getElementById('openPopup').addEventListener('click', function() {
  // URL do arquivo que você deseja carregar na janela pop-up
  var url = 'colecao.php';
  
  // Configuração da janela pop-up
  var width = 600;
  var height = 400;

  // Abre a janela pop-up usando JavaScript
  var popup = window.open(url, 'Pop-up', 'width=' + width + ', height=' + height);
});
</script>

<script>
    document.getElementById('openPopup2').addEventListener('click', function() {
  // URL do arquivo que você deseja carregar na janela pop-up
  var url = 'marca.php';
  
  // Configuração da janela pop-up
  var width = 600;
  var height = 400;

  // Abre a janela pop-up usando JavaScript
  var popup = window.open(url, 'Pop-up', 'width=' + width + ', height=' + height);
});
</script>

<script>
    document.getElementById('openPopup3').addEventListener('click', function() {
  // URL do arquivo que você deseja carregar na janela pop-up
  var url = 'subgrupo.php';
  
  // Configuração da janela pop-up
  var width = 600;
  var height = 400;

  // Abre a janela pop-up usando JavaScript
  var popup = window.open(url, 'Pop-up', 'width=' + width + ', height=' + height);
});
</script>
</body>
</html>