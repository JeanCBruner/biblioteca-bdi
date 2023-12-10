<h1>Finalizar Locação</h1>
<?php
$locacaoId = $_REQUEST['id_locacao'];
$sql1 = "SELECT locacao.*, leitor.nome AS leitorNome, livro.nome AS livroNome
         FROM locacao
         INNER JOIN livro ON livro.id = locacao.livro_id
         INNER JOIN leitor ON leitor.id = locacao.leitor_id
         WHERE locacao.id = $locacaoId";

$res1 = $conn->query($sql1);
$row1 = $res1->fetch_object();
?>

<form action="?page=locacao_salvar" method="POST">
    <input type="hidden" name="acao" value="finalizar">
    <input type="hidden" name="id_locacao" value="<?php print $row1->id; ?>">

    <div class="mb-3">
        <label>Leitor</label>
        <input type="text" value="<?php print $row1->leitorNome; ?>" name="leitor_nome" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label>Livro</label>
        <input type="text" value="<?php print $row1->livroNome; ?>" name="livro_nome" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label>Data Locação</label>
        <input type="text" value="<?php print $row1->dataLocacao; ?>" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label>Data Devolução Estimada</label>
        <input type="text" value="<?php print $row1->dataDevolucaoEstimada; ?>" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="data_devolucao_real">Data Devolucao Real</label>
        <input type="date" value="<?php print $row1->dataDevolucaoReal; ?>" name="data_devolucao_real" id="data_devolucao_real" class="form-control" min="<?php print $row1->dataLocacao; ?>" onchange="atualizaValorMulta()">
    </div>

    <div class="mb-3">
        <label>Valor Locação</label>
        <input type="text" value="<?php print $row1->valorLocacao; ?>" name="valor_locacao" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="valor_multa">Multa</label>
        <input type="text" value="" name="valor_multa_display" id="valor_multa_display" class="form-control" readonly>
        <!-- Campo oculto para armazenar o valor da multa -->
        <input type="hidden" value="" name="valor_multa" id="valor_multa">
    </div>

    <div class="mb-3">
        <label for="valor_final">Valor Total</label>
        <input type="text" value="" name="valor_final_display" id="valor_final_display" class="form-control" readonly>
        <!-- Campo oculto para armazenar o valor total -->
        <input type="hidden" value="" name="valor_final" id="valor_final">
    </div>


    <div class="mb-3">
        <label>Observações Iniciais</label>
        <textarea name="observacoes_iniciais" class="form-control" readonly><?php print $row1->observacoesIniciais; ?></textarea>
    </div>

    <div class="mb-3">
        <label>Observações Finais</label>
        <textarea name="observacoes_finais" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-lg btn-block">Finalizar</button>
</form>

<script>
    function calcularMulta(dataDevolucaoReal, dataDevolucaoEstimada) {
        var diferencaDias = (dataDevolucaoReal - dataDevolucaoEstimada) / (1000 * 60 * 60 * 24);
        diferencaDias = Math.max(0, diferencaDias);

        // Ajuste o valor da multa conforme necessário
        var multa = diferencaDias * 0.5;

        return multa;
    }

    function atualizaValorMulta() {
        var dataDevolucaoEstimada = new Date("<?php print $row1->dataDevolucaoEstimada; ?>");
        var dataDevolucaoReal = new Date(document.forms[0].elements['data_devolucao_real'].value);

        var valorMulta = calcularMulta(dataDevolucaoReal, dataDevolucaoEstimada);
        var valorTotal = parseFloat(<?php print $row1->valorLocacao; ?>) + parseFloat(valorMulta);

        var valorMultaDisplay = document.getElementById('valor_multa_display');
        var valorFinalDisplay = document.getElementById('valor_final_display');
        var valorMultaHidden = document.getElementById('valor_multa');
        var valorFinalHidden = document.getElementById('valor_final');

        // Verificar se os elementos existem antes de tentar acessar a propriedade value
        if (valorMultaDisplay && valorFinalDisplay && valorMultaHidden && valorFinalHidden) {
            // Atualiza os campos de exibição visíveis ao usuário
            valorMultaDisplay.value = 'R$ ' + valorMulta.toFixed(2);
            valorFinalDisplay.value = 'R$ ' + valorTotal.toFixed(2);

            // Atualiza os campos ocultos com os valores calculados
            valorMultaHidden.value = parseFloat(valorMulta.toFixed(2));
            valorFinalHidden.value = parseFloat(valorTotal.toFixed(2));
        }
    }

    // Chama a função quando a página é carregada para preencher os campos inicialmente
    window.onload = function () {
        atualizaValorMulta();
    };
</script>