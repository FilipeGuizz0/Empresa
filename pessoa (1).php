<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('empresa');

if (isset($_POST['gravar'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $relacao = $_POST['relacao'];
    $telefone = $_POST['telefone'];

    $sql = "insert into pessoa (codigo, nome, cpf, relacao, telefone) 
        values ('$codigo', '$nome', '$cpf', '$relacao', '$telefone')";

    $resultado = mysql_query($sql);
    if ($resultado) {
        echo "Dados gravados com sucesso.";
    } else {
        echo "Erro ao gravar os dados.";
    }
}

if (isset($_POST['alterar'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $relacao = $_POST['relacao'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE pessoa SET nome = '$nome', cpf = '$cpf', relacao = '$relacao', telefone = '$telefone'
        WHERE codigo = '$codigo'";

    $resultado = mysql_query($sql);
    if ($resultado) {
        echo "Dados alterados com sucesso.";
    } else {
        echo "Erro ao alterar os dados.";
    }
}

if (isset($_POST['excluir'])) {
    $codigo = $_POST['codigo'];

    $sql = "delete from pessoa where codigo = '$codigo'";

    $resultado = mysql_query($sql);
    if ($resultado) {
        echo "Dados excluídos com sucesso.";
    } else {
        echo "Erro ao excluir os dados.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="box.css">
    <meta charset="UTF-8">
    <title>pessoa</title>
</head>
<body>
    <div id="box">
        <form name="formulario" method="post" action="pessoa.php">
            <h1>Cadastro pessoa</h1>
            Código:
            <input type="text" name="codigo" id="codigo" size=50>
            <br><br>
            Nome:
            <input type="text" name="nome" id="nome" size=50>
            <br><br>
            CPF:
            <input type="number" name="cpf" id="cpf" size=50>
            <br><br>
            Relação:
            <select name="relacao" id="relacao">
                <option value=0 selected="selected">Selecione categoria ...</option>
                <option value=cliente selected="selected">Cliente</option>
                <option value=0 selected="selected">Fornecedor</option>
            </select>
            <br><br>
            Telefone:
            <input type="number" name="telefone" id="telefone" size=50>
            <br><br>

            <input type="submit" name="gravar" id="gravar" value="Gravar">
            <input type="submit" name="alterar" id="alterar" value="Alterar">
            <input type="submit" name="excluir" id="excluir" value="Excluir">
            <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
            <br><br>
            <a href="Home.html">Voltar</a>
        </form>

        <?php
if (isset($_POST['pesquisar'])) {
    $sql = "select * from pessoa";
    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0) {
        echo "Sua pesquisa não retornou resultados ";
    } else {
        echo "<h2>Resultado da Pesquisa por pessoas</h2>";
        echo "<table id='result-table' align='center' border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>";
        echo "<tr style='background-color: #469bd2; color: white;'>";
        echo "<th>Código</th><th>Nome</th><th>CPF</th><th>Relação</th><th>Telefone</th>";
        echo "</tr>";
        while ($pessoa = mysql_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>".$pessoa['codigo']."</td>";
            echo "<td>".$pessoa['nome']."</td>";
            echo "<td>".$pessoa['cpf']."</td>";
            echo "<td>".$pessoa['relacao']."</td>";
            echo "<td>".$pessoa['telefone']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

    </div>
</body>
</html>
