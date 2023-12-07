<h1>Cadastrar leitor</h1>

<form action="?page=leitor_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    
    <div class="mb-3">
        <label>Nome do leitor</label>
        <input type="text" name="nome_leitor" class="form-control" placeholder="Nome" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="tel" name="telefone_leitor" class="form-control" placeholder="Telefone" required>
    </div>

    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento_leitor" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
    </div>
</form>
