<h1>Editar Leitor</h1>

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
        <input type="text" name="telefone_leitor" maxlength="11" class="form-control" value="<?php print $row->telefone; ?>" required>
    </div>

    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento_leitor" class="form-control" value="<?php print $row->dataNascimento; ?>" required>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>

<script>
    document.addEventListener('input', function (e) {
        if (e.target.getAttribute('name') === 'telefone_leitor') {
            // Remover caracteres não numéricos
            e.target.value = e.target.value.replace(/[^0-9]/g, '');

            // Limitar o comprimento a pelo menos 8 dígitos
            if (e.target.value.length < 8) {
                e.target.setCustomValidity('Informe um número de telefone válido com pelo menos 8 dígitos.');
            } else {
                e.target.setCustomValidity('');
            }
        }
    });
</script>
