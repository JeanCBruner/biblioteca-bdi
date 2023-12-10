<h1 class="mb-3">Realizar Locação</h1>

<form action="?page=locacao_salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Leitor</label>
        <select class="form-control js-example-responsive" name="leitor_id_leitor" required>
            <?php
            $sql = "SELECT * FROM leitor ORDER BY nome ASC";
            $res = $conn->query($sql);

            if ($res->num_rows > 0) {
                while ($row = $res->fetch_object()) {
                    print "<option value='" . $row->id . "'>" . $row->nome . "</option>";
                }
            } else {
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Livro</label>
        <select class="form-control js-example-responsive" name="livro_id_livro" required>
            <?php
            $sql2 = "SELECT * FROM livro WHERE qtdExemplares > 0 ORDER BY nome ASC";
            $res2 = $conn->query($sql2);

            if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_object()) {
                    print "<option value='" . $row2->id . "'>" . $row2->nome . "</option>";
                }
            } else {
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="data_locacao">Data de Locação</label>
        <input type="date" name="data_locacao" class="form-control" id="data_locacao" required>
    </div>

    <div class="form-group">
        <label for="data_devolucaoE">Data de Devolução</label>
        <input type="date" name = "data_devolucaoE" class="form-control" id="data_devolucaoE" disabled required>
    </div>

    <div class="form-group">
        <label for="valor_locacao">Valor da Locação</label>
        <input type="text" name="valor_locacao" class="form-control" id="valor_locacao" readonly required>
    </div>

    <div class="mb-3">
        <label>Observações</label>
        <textarea type="text" name = "observacao_inicial" class="form-control" rows ="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-lg btn-block">Enviar</button>
</form>

<script>
    $(document).ready(function () {
        $('.js-example-responsive').select2();
    });

    document.addEventListener('DOMContentLoaded', function () {
        var data_locacao = document.getElementById('data_locacao');
        var data_devolucaoE = document.getElementById('data_devolucaoE');
        var valor_locacao = document.getElementById('valor_locacao');

        data_locacao.addEventListener('input', function () {
            data_devolucaoE.disabled = false;

            var dataSelecionada1 = new Date(data_locacao.value);
            var dataMinima2 = new Date(dataSelecionada1);
            dataMinima2.setDate(dataMinima2.getDate() + 1);

            data_devolucaoE.min = dataMinima2.toISOString().split('T')[0];

            // Calcular valor da locação
            calcularValorLocacao();
        });

        data_devolucaoE.addEventListener('input', function () {
            // Calcular valor da locação
            calcularValorLocacao();
        });

        function calcularValorLocacao() {
            var dataLocacao = new Date(data_locacao.value);
            var dataDevolucaoE = new Date(data_devolucaoE.value);

            // Calcular a diferença em dias
            var diffEmDias = (dataDevolucaoE - dataLocacao) / (1000 * 60 * 60 * 24);

            // Calcular o valor da locação
            var valorLocacaoCalculado = diffEmDias * 2;

            // Atualizar o campo de valor da locação
            valor_locacao.value = valorLocacaoCalculado.toFixed(2);
        }
    });
</script>