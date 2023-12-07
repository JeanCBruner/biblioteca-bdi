<h1>Editar categoria</h1>
<?php

    $sql = "SELECT * FROM categoria WHERE id = ".$_REQUEST['id_categoria'];
    $res = $conn->query($sql);
    $row = $res->fetch_object();
?>
<form action="?page=categoria_salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_categoria" value="<?php print $row->id?>">
    <div class="mb-3">
        <label>Nome da categoria</label>
        <input type="text" name = "nome_categoria" class="form-control" value="<?php print $row->nome?> ">
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <input type="text" name = "descricao_categoria" class="form-control" value="<?php print $row->descricao?> ">
    </div>
    <div class="mb-3">
        <button type="submit" class = "btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>