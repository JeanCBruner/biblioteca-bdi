<h1>Cadastrar Categoria</h1>

<form action="?page=categoria_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label>Nome da categoria</label>
        <input type="text" name = "nome_categoria" class="form-control" placeholder="Nome" required>
    </div>
    <div class="mb-3">
        <label>Descrição</label>
        <input type="text" name = "descricao_categoria" class="form-control" placeholder="Descrição">
    </div>
    <div class="mb-3">
        <button type="submit" class = "btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>