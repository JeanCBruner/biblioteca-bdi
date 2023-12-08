<h1>Ultimo livro alugado</h1>
<?php
$sql = "SELECT
            leitor.id AS leitor_id,
            leitor.nome AS nome_leitor,
            total_locacoes_finalizadas.total_locacoes_finalizadas,
            livro_recente_ativo.nome_livro AS livro_mais_recente_ativo,
            livro_recente_finalizado.nome_livro AS livro_mais_recente_finalizado
        FROM 
            leitor
        LEFT JOIN (
                    SELECT 
                        leitor_id
                    FROM 
                        locacao
                    WHERE 
                        status_locacao_id = 1
                    GROUP BY leitor_id
                ) AS total_locacoes_ativas ON leitor.id = total_locacoes_ativas.leitor_id
        LEFT JOIN (
                    SELECT 
                        leitor_id, COUNT(id) AS total_locacoes_finalizadas
                    FROM 
                        locacao
                    WHERE 
                        status_locacao_id = 2
                    GROUP BY leitor_id
                ) AS total_locacoes_finalizadas ON leitor.id = total_locacoes_finalizadas.leitor_id

        LEFT JOIN (
                    SELECT 
                        leitor_id, livro.nome AS nome_livro, MAX(dataLocacao) AS data_mais_recente
                    FROM 
                        locacao
                    INNER JOIN livro ON (locacao.livro_id = livro.id)
                    WHERE 
                        status_locacao_id = 1
                    GROUP BY leitor_id
                ) AS livro_recente_ativo ON leitor.id = livro_recente_ativo.leitor_id

        LEFT JOIN (
                    SELECT 
                        leitor_id, livro.nome AS nome_livro, MAX(dataDevolucaoReal) AS data_mais_recente
                    FROM 
                        locacao
                    INNER JOIN livro ON (locacao.livro_id = livro.id)
                    WHERE 
                        status_locacao_id = 2
                    GROUP BY leitor_id
                ) AS livro_recente_finalizado ON leitor.id = livro_recente_finalizado.leitor_id";

$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s). </p>";
    print "<table class='table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Nome do Leitor</th>";
    print "<th>Locações Finalizadas</th>";
    print "<th>Livro Mais Recente (Ativo)</th>";
    print "<th>Livro Mais Recente (Finalizado)</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->leitor_id . "</td>";
        print "<td>" . $row->nome_leitor . "</td>";
        print "<td>" . $row->total_locacoes_finalizadas . "</td>";
        print "<td>" . $row->livro_mais_recente_ativo . "</td>";
        print "<td>" . $row->livro_mais_recente_finalizado . "</td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
