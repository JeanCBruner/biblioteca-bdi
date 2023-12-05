<h1>Editar editora</h1>
<?php

    $sql = "SELECT * FROM editora WHERE id = ".$_REQUEST['id_editora'];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>
<form action="?page=editora_salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_editora" value="<?php print $row->id?>">
    <div class="mb-3">
        <label>Nome da editora</label>
        <input type="text" name = "nome_editora" class="form-control" value="<?php print $row->nome?> ">
    </div>
    <div class="mb-3">
        <button type="submit" class = "btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>