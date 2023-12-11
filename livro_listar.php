<h1>Listar Livros</h1>

<?php

$sql = "SELECT  livro.id AS idLivro, livro.nome AS nomeLivro, 
                autor, 
                anoPublicacao, 
                qtdExemplares, 
                GROUP_CONCAT(categoria.nome ORDER BY categoria.nome ASC) AS categorias, 
                editora.nome AS nomeEditora
        FROM livro
        INNER JOIN livro_categoria ON (livro.id = livro_categoria.livro_id)
        INNER JOIN categoria ON (categoria.id = livro_categoria.categoria_id)
        INNER JOIN editora ON (editora.id = livro.editora_id)
        GROUP BY livro.id";

$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s). </p>";
    print "<table class='table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Nome</th>";
    print "<th>Autor</th>";
    print "<th>Ano de Publicação</th>";
    print "<th>Editora</th>";
    print "<th>Categorias</th>";
    print "<th>Exemplares</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->idLivro . "</td>";
        print "<td>" . $row->nomeLivro . "</td>";
        print "<td>" . $row->autor . "</td>";
        print "<td>" . $row->anoPublicacao . "</td>";
        print "<td>" . $row->nomeEditora . "</td>";
        print "<td>" . $row->categorias . "</td>";
        print "<td>" . $row->qtdExemplares . "</td>";
        print "<td>
            <button onclick=\"location.href='?page=livro_editar&id_livro=" . $row->idLivro . "';\" 
            class ='btn btn-primary btn-block'>Editar</button>
            <button onclick=\"location.href='?page=livro_salvar&acao=excluir&id_livro=" . $row->idLivro . "'\" 
            class ='btn btn-danger btn-block'>Excluir</button>
        </td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
?>
