<h1>Editar leitor</h1>

<?php
    $sql = "SELECT * FROM leitor WHERE id = ".$_REQUEST['id_leitor'];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>

<form action="?page=leitor_salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_leitor" value="<?php print $row->id; ?>">
    
    <div class="mb-3">
        <label>Nome do leitor</label>
        <input type="text" name="nome_leitor" class="form-control" value="<?php print $row->nome; ?>" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="tel" name="telefone_leitor" class="form-control" value="<?php print $row->telefone; ?>" required>
    </div>

    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento_leitor" class="form-control" value="<?php print $row->dataNascimento; ?>" required>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>
