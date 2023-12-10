<h1>Cadastrar Livro</h1>

<form action="?page=livro_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Categoria</label>
        <select class="form-control js-example-basic-multiple" name="categoria_id_categoria[]" multiple="multiple" required>
            <?php
            $sql = "SELECT * FROM categoria ORDER BY nome ASC";
            $res = $conn->query($sql);

            if ($res->num_rows > 0) {
                while ($row = $res->fetch_object()) {
                    print "<option value='" . $row->id . "'>" . $row->nome . "</option>";
                }
            } else {
                print "<option>Não há categorias cadastradas</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Editora</label>
        <select class="form-control js-example-responsive" name="editora_id_editora" required>
            <?php
            $sql2 = "SELECT * FROM editora ORDER BY nome ASC";
            $res2 = $conn->query($sql2);

            if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_object()) {
                    print "<option value='" . $row2->id . "'>" . $row2->nome . "</option>";
                }
            } else {
                print "<option>Não há editoras cadastradas</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label>Nome do livro</label>
        <input type="text" name="nome_livro" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="nome_autor" class="form-control" required>
    </div>
    <div class="mb-3">
    <label>Ano de Publicação</label>
    <input type="number" name="ano_publicacao" class="form-control" pattern="\d{4}" title="Digite um ano válido com 4 dígitos" min="1800" max="2100">
</div>


    <div class="mb-3">
        <label>Quantidade de exemplares</label>
        <input type="text" name="qtd_exemplares" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
</form>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-example-responsive').select2();
    });
</script>