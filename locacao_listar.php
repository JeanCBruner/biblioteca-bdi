<h1>Locações ATIVAS</h1>

<?php

$sql = "SELECT 
            locacao.id AS idLocacao, 
            leitor.nome AS leitorNome, 
            livro.nome AS livroNome,
            dataDevolucaoEstimada, 
            dataDevolucaoReal,       
            dataLocacao, 
            valorLocacao,
            valorMulta, 
            valorFinal, 
            observacoesIniciais 
        FROM 
            locacao
        INNER JOIN livro ON (livro.id = locacao.livro_id)
        INNER JOIN leitor ON (leitor.id = locacao.leitor_id)
        INNER JOIN status_locacao ON (status_locacao.id = locacao.status_locacao_id)
        WHERE 
            status_locacao_id = '1'";

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
    print "<th>Observações</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr";
        $dataAtual = date('Y-m-d');
        if (strtotime($dataAtual) > strtotime($row->dataDevolucaoEstimada)) {
            print " style='color: red;'";
        }
        print ">";

        print "<td>" . $row->idLocacao . "</td>";
        print "<td>" . $row->leitorNome . "</td>";
        print "<td>" . $row->livroNome . "</td>";
        print "<td>" . date('d/m/Y', strtotime($row->dataLocacao)) . "</td>";
        print "<td>" . date('d/m/Y', strtotime($row->dataDevolucaoEstimada)) . "</td>";
        print "<td>" . $row->observacoesIniciais . "</td>";
        print "<td>
            <button onclick=\"location.href='?page=locacao_finalizar&id_locacao=" . $row->idLocacao . "';\" class ='btn btn-success btn-block'>Finalizar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja cancelar?')){location.href='?page=locacao_salvar&acao=excluir&id_locacao=" . $row->idLocacao . "';}else{false;}\" class ='btn btn-danger btn-block'>Cancelar</button>
        </td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
?>
