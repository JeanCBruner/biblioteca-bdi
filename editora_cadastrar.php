<h1>Cadastrar editora</h1>

<form action="?page=editora_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label>Nome da editora</label>
        <input type="text" name = "nome_editora" class="form-control" placeholder="Nome" required>
    </div>
    <div class="mb-3">
        <button type="submit" class = "btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>