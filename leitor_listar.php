<h1>Listar Leitores</h1>

<?php

$sql = "SELECT * FROM leitor ORDER BY nome ASC";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<p>Encontrou <b>$qtd</b> resultado(s). </p>";
    print "<table class='table table-bordered table-striped table-hover'>";
    print "<tr>";
    print "<th>#</th>";
    print "<th>Nome</th>";
    print "<th>Telefone</th>";
    print "<th>Data de Nascimento</th>";
    print "<th>Ações</th>";
    print "</tr>";
    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td>" . $row->id . "</td>";
        print "<td>" . $row->nome . "</td>";
        print "<td>" . $row->telefone . "</td>";
        print "<td>" . date('d/m/Y', strtotime($row->dataNascimento)) . "</td>";
        print "<td>
            <button onclick=\"location.href='?page=leitor_editar&id_leitor=" . $row->id . "';\" 
            class='btn btn-primary btn-block'>Editar</button>
            <button onclick=\"if(confirm('Tem certeza que deseja excluir?'))
            {location.href='?page=leitor_salvar&acao=excluir&id_leitor=" . $row->id . "';}else{false;}\" 
            class='btn btn-danger btn-block'>Excluir</button>
        </td>";
        print "</tr>";
    }
    print "</table>";
} else {
    print "<p>Não encontrou resultado.</p>";
}
?>
