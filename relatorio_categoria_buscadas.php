<h1>Categorias mais buscadas</h1>

<?php
// Consulta para obter as categorias mais buscadas
$sqlCategoriasBuscadas = "
    SELECT 
        categoria.nome AS nome_categoria,
        COUNT(locacao.id) AS total_locacoes
    FROM 
        locacao
    INNER JOIN livro ON locacao.livro_id = livro.id
    INNER JOIN livro_categoria ON livro.id = livro_categoria.livro_id
    INNER JOIN categoria ON livro_categoria.categoria_id = categoria.id
    GROUP BY categoria.id
    ORDER BY total_locacoes DESC";

$resultadoCategoriasBuscadas = $conn->query($sqlCategoriasBuscadas);

if ($resultadoCategoriasBuscadas) {
    $qtdCategorias = $resultadoCategoriasBuscadas->num_rows;

    if ($qtdCategorias > 0) {
        print "<p>Encontrou <b>$qtdCategorias</b> categoria(s) mais buscada(s).</p>";
        print "<table class='table table-bordered table-striped table-hover'>";
        print "<tr>";
        print "<th>Posição</th>";
        print "<th>Nome da Categoria</th>";
        print "<th>Total de Locações</th>";
        print "</tr>";

        $count = 1;
        while ($rowCategoria = $resultadoCategoriasBuscadas->fetch_object()) {
            print "<tr>";
            print "<td>" . $count++ . "</td>";
            print "<td>" . $rowCategoria->nome_categoria . "</td>";
            print "<td>" . $rowCategoria->total_locacoes . "</td>";
            print "</tr>";
        }

        print "</table>";
    } else {
        print "<p>Não foram encontradas categorias mais buscadas.</p>";
    }
} else {
    // Tratar erros na consulta, se necessário
    print "<p>Erro na consulta de categorias mais buscadas.</p>";
}
?>
