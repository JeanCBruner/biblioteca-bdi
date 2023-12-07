<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        // Dados da locação
        $dataLocacao = $_POST['data_locacao'];
        $dataDevolucaoEstimada = $_POST['data_devolucaoE'];
        $observacoes = $_POST['observacao'];
        $livroId = $_POST['livro_id_livro'];
        $leitorId = $_POST['leitor_id_leitor'];
        $statusLocacaoId = 1; // Definindo o status (assumindo que 1 é o status padrão)
        $valorLocacao = $_POST['valor_locacao']; // Utilizando o valor já fornecido

        // Inserção da locação
        $sqlLocacao = "INSERT INTO locacao (dataLocacao, dataDevolucaoEstimada, observacoes, livro_id, leitor_id, status_locacao_id, valorLocacao) VALUES (
            '$dataLocacao', 
            '$dataDevolucaoEstimada',
            '$observacoes',
            '$livroId', 
            '$leitorId',
            '$statusLocacaoId',
            '$valorLocacao'
        )";

        $resLocacao = $conn->query($sqlLocacao);

        if ($resLocacao) {
            print "<script>alert('Locação realizada com sucesso!');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        } else {
            print "<script>alert('Não foi possível realizar a operação!');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        }
        break;
    case 'finalizar':
        // Dados da locação
        $locacaoId = $_POST['id_locacao'];
        $dataDevolucaoReal = $_POST['data_devolucao_real'];
        $multa = $_POST['valor_multa'];
        $total = $_POST['valor_final'];

        $sqlLocacao = "UPDATE locacao SET
                            dataDevolucaoReal = '$dataDevolucaoReal',
                            valorMulta = '$multa',
                            valorFinal = '$total',
                            status_locacao_id = 2
                        WHERE
                            id = '$locacaoId'";

        $resLocacao = $conn->query($sqlLocacao);

        // Verificar se a atualização foi bem-sucedida
        if ($resLocacao) {
            print "<script>alert('Locação finalizada com sucesso!');</script>";
            // print "<script>location.href='?page=locacao_listar';</script>";
        } else {
            print "<script>alert('Não foi possível finalizar a locação!');</script>";
            // print "<script>location.href='?page=locacao_listar';</script>";
        }

        break;
    case 'excluir':

        $idLocacao = $_REQUEST['id_locacao'];
        $sqlteste = "SELECT dataLocacao FROM locacao WHERE id = $idLocacao";

        $res = $conn->query($sqlteste);

        if ($res) {
            $row = $res->fetch_object();
            $dataLocacao = $row->dataLocacao;

            // Agora você pode usar $dataLocacao conforme necessário
        } else {
            // Trate o caso em que a consulta falhou
            echo "Erro ao executar a consulta: " . $conn->error;
        }
        $dataAtual = date('Y-m-d');

        if (strtotime($dataAtual) <= strtotime($dataLocacao)) {
            // O dia atual é igual ou inferior à dataLocacao, permitir exclusão
            // Exclusão da locação
            $deleteLocacaoSql = "DELETE FROM locacao WHERE id = " . $_REQUEST['id_locacao'];
            $resLocacao = $conn->query($deleteLocacaoSql);

            if ($resLocacao == true) {
                print "<script>alert('Locação cancelada com sucesso!');</script>";
                print "<script>location.href='?page=locacao_listar';</script>";
            } else {
                print "<script>alert('Não foi possível cancelar a locação!');</script>";
                print "<script>location.href='?page=locacao_listar';</script>";
            }
        } else {
            // O dia atual é superior à dataLocacao, mostrar mensagem de erro
            print "<script>alert('Não é permitido cancelar locações com datas de locação passadas.');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        }

    default:
        # code...
        break;
}
