<h1>Cadastrar Leitor</h1>

<form action="?page=leitor_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Nome do leitor</label>
        <input type="text" name="nome_leitor" class="form-control" placeholder="Nome" maxlength="150" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="tel" name="telefone_leitor" class="form-control" maxlength="11" placeholder="Telefone" required pattern="[0-9]{8,}">
    </div>

    <div class="mb-3">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento_leitor" class="form-control" required>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success btn-lg btn-block">Cadastrar</button>
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
