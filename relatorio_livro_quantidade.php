<h1>Livros Mais Alugados</h1>

<?php
// Consulta para obter os livros mais alugados
$sqlLivrosMaisAlugados = "
    SELECT 
        livro.nome AS nome_livro,
        COUNT(locacao.id) AS total_locacoes
    FROM 
        locacao
    INNER JOIN livro ON locacao.livro_id = livro.id
    GROUP BY livro.id
    ORDER BY total_locacoes DESC";

$resultadoLivrosMaisAlugados = $conn->query($sqlLivrosMaisAlugados);

if ($resultadoLivrosMaisAlugados) {
    $qtdLivros = $resultadoLivrosMaisAlugados->num_rows;

    if ($qtdLivros > 0) {
        print "<p>Encontrou <b>$qtdLivros</b> livro(s) mais alugado(s).</p>";
        print "<table class='table table-bordered table-striped table-hover'>";
        print "<tr>";
        print "<th>Posição</th>";
        print "<th>Nome do Livro</th>";
        print "<th>Total de Locações</th>";
        print "</tr>";

        $count = 1;
        while ($rowLivro = $resultadoLivrosMaisAlugados->fetch_object()) {
            print "<tr>";
            print "<td>" . $count++ . "</td>";
            print "<td>" . $rowLivro->nome_livro . "</td>";
            print "<td>" . $rowLivro->total_locacoes . "</td>";
            print "</tr>";
        }

        print "</table>";
    } else {
        print "<p>Não foram encontrados livros mais alugados.</p>";
    }
} else {
    // Tratar erros na consulta, se necessário
    print "<p>Erro na consulta de livros mais alugados.</p>";
}
?>
