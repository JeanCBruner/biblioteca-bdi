<h1>Locações FINALIZADAS</h1>

<?php

$sql = "SELECT 
             locacao.id AS idLocacao, leitor.nome AS leitorNome, livro.nome AS livroNome, dataDevolucaoEstimada, dataDevolucaoReal, dataLocacao, valorMulta, valorFinal, observacoesIniciais, observacoesFinais 
        FROM 
            locacao
        INNER JOIN livro ON (livro.id = locacao.livro_id)
        INNER JOIN leitor ON (leitor.id = locacao.leitor_id)
        INNER JOIN status_locacao ON (status_locacao.id = locacao.status_locacao_id)
        WHERE 
            status_locacao_id = '2'"; // Alterado para status_locacao_id = '2' para locações finalizadas

$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s). </p>";
    print "<table class = 'table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Leitor</th>";
    print "<th>Livro</th>";
    print "<th>Data Locação</th>";
    print "<th>Data Devolução Estimada</th>";
    print "<th>Data Devolução Real</th>";
    print "<th>Valor Multa</th>";
    print "<th>Valor Final</th>";
    print "<th>Observações Iniciais</th>";
    print "<th>Observações Finais</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        $dataDevolucaoEstimada = strtotime($row->dataDevolucaoEstimada);
        $dataDevolucaoReal = strtotime($row->dataDevolucaoReal);

        print "<tr";
        // Verificar se a data de devolução real foi maior que a data de devolução estimada
        if ($dataDevolucaoReal > $dataDevolucaoEstimada) {
            print " style='color: red;'";
        }
        print ">";
        print "<td>" . $row->idLocacao . "</td>";
        print "<td>" . $row->leitorNome . "</td>";
        print "<td>" . $row->livroNome . "</td>";
        print "<td>" . date('d/m/Y', strtotime($row->dataLocacao)) . "</td>";
        print "<td>" . date('d/m/Y', $dataDevolucaoEstimada) . "</td>";
        print "<td>" . date('d/m/Y', $dataDevolucaoReal) . "</td>";
        // Verificar se há valor de multa
        if ($row->valorMulta) {
            print "<td>R$ " . number_format($row->valorMulta, 2, ',', '.') . "</td>";
        } else {
            print "<td>Entregue no prazo</td>";
        }
        print "<td>R$ " . number_format($row->valorFinal, 2, ',', '.') . "</td>";
        print "<td>" . $row->observacoesIniciais . "</td>";
        print "<td>" . $row->observacoesFinais . "</td>";

        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
?>
