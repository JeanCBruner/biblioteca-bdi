<h1>Clientes com mais Locações Finalizadas</h1>

<?php
// Consulta para obter os clientes com mais locações finalizadas
$sqlClientesLocacoesFinalizadas = "
    SELECT 
        leitor.nome AS nome_leitor,
        COUNT(locacao.id) AS total_locacoes_finalizadas
    FROM 
        locacao
    INNER JOIN leitor ON locacao.leitor_id = leitor.id
    WHERE
        locacao.status_locacao_id = 2
    GROUP BY leitor.id
    ORDER BY total_locacoes_finalizadas DESC";

$resultadoClientesLocacoesFinalizadas = $conn->query($sqlClientesLocacoesFinalizadas);

if ($resultadoClientesLocacoesFinalizadas) {
    $qtdClientes = $resultadoClientesLocacoesFinalizadas->num_rows;

    if ($qtdClientes > 0) {
        print "<p>Encontrou <b>$qtdClientes</b> cliente(s) com mais locações finalizadas.</p>";
        print "<table class='table table-bordered table-striped table-hover'>";
        print "<tr>";
        print "<th>Posição</th>";
        print "<th>Nome do Cliente</th>";
        print "<th>Total de Locações Finalizadas</th>";
        print "</tr>";

        $count = 1;
        while ($rowCliente = $resultadoClientesLocacoesFinalizadas->fetch_object()) {
            print "<tr>";
            print "<td>" . $count++ . "</td>";
            print "<td>" . $rowCliente->nome_leitor . "</td>";
            print "<td>" . $rowCliente->total_locacoes_finalizadas . "</td>";
            print "</tr>";
        }

        print "</table>";
    } else {
        print "<p>Não foram encontrados clientes com locações finalizadas.</p>";
    }
} else {
    // Tratar erros na consulta, se necessário
    print "<p>Erro na consulta de clientes com locações finalizadas.</p>";
}
?>
