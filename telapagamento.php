<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('empresa');


$sql_produtos       = "SELECT codigo, descricao FROM produtos ";
$pesquisar_produtos = mysql_query($sql_produtos);

$sql_tamanhos       = "SELECT codigo, tamanhos FROM tamanhos ";
$pesquisar_tamanhos = mysql_query($sql_tamanhos);




if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
$codproduto = $_POST['codproduto'];
$codtamanho = $_POST['codtamanho'];
$quantidade = $_POST['quantidade'];

// Consulta para obter a quantidade atual do produto
$query = "SELECT quantidadeatual FROM produtostamanho WHERE codigo = '$codigo'";
$result = mysql_query($query);

if ($result) {
    $row = mysql_fetch_assoc($result);
    $quantidadeatual = $row['quantidadeatual'];

    // Agora você pode continuar com o restante do código
    $novaQuantidade = $quantidadeatual - $quantidade;

    $updateQuery = "UPDATE produtostamanho SET quantidadeatual = $novaQuantidade WHERE codigo = '$codigo'";
    $updateResult = mysql_query($updateQuery);

    if ($updateResult) {
        echo "Dados alterados com sucesso.";
    } else {
        echo "Erro ao alterar os dados: " . mysql_error();
    }
} else {
    echo "Produto não encontrado ou erro na consulta da quantidade atual.";
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
        <form name="formulario" method="post" action="telapagamento.php">
            <h1>Cadastro Corrente</h1>
            Codigo:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            Quantidade:
            <input type="number" name="quantidade" id="quantidade" size=50>
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
            <input type="submit" name="alterar"   id="alterar"   value="Alterar">
            <br><br>
            <a href="Home.html">Voltar</a>
        </form>
    </div>
</body>
</html>
