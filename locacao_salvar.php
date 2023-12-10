<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        // Dados da locação
        $dataLocacao = $_POST['data_locacao'];
        $dataDevolucaoEstimada = $_POST['data_devolucaoE'];
        $observacoesIniciais = $_POST['observacao_inicial'];
        $livroId = $_POST['livro_id_livro'];
        $leitorId = $_POST['leitor_id_leitor'];
        $statusLocacaoId = 1; // Definindo o status (assumindo que 1 é o status padrão)
        $valorLocacao = $_POST['valor_locacao']; // Utilizando o valor já fornecido
    
        // Verificar se o leitor tem locações ativas
        $sqlVerificarLocacoesAtivas = "SELECT COUNT(id) AS qtd_locacoes_ativas
                                        FROM locacao
                                        WHERE leitor_id = $leitorId
                                        AND status_locacao_id = 1";
    
        $resultadoVerificacao = $conn->query($sqlVerificarLocacoesAtivas);
    
        if ($resultadoVerificacao) {
            $rowVerificacao = $resultadoVerificacao->fetch_assoc();
            $qtdLocacoesAtivas = $rowVerificacao['qtd_locacoes_ativas'];
    
            if ($qtdLocacoesAtivas > 0) {
                // O usuário tem locações em aberto, não pode locar um novo livro
                print "<script>alert('O leitor possui locações em aberto e não pode locar um novo livro no momento.');</script>";
                print "<script>location.href='?page=locacao_listar';</script>";
            } else {
                // O usuário não tem locações em aberto, prosseguir com a inserção da locação
                // Inserção da locação
                $sqlLocacao = "INSERT INTO locacao (dataLocacao, dataDevolucaoEstimada, observacoesIniciais, livro_id, leitor_id, status_locacao_id, valorLocacao) VALUES (
                    '$dataLocacao', 
                    '$dataDevolucaoEstimada',
                    '$observacoesIniciais',
                    '$livroId', 
                    '$leitorId',
                    '$statusLocacaoId',
                    '$valorLocacao'
                )";
    
                $resLocacao = $conn->query($sqlLocacao);
    
                if ($resLocacao) {
                    $sqlDecrementExemplares = "UPDATE livro SET qtdExemplares = qtdExemplares - 1 WHERE id = '$livroId'";
                    $conn->query($sqlDecrementExemplares);

                    print "<script>alert('Locação realizada com sucesso!');</script>";
                    print "<script>location.href='?page=locacao_listar';</script>";
                } else {
                    print "<script>alert('Não foi possível realizar a operação!');</script>";
                    print "<script>location.href='?page=locacao_listar';</script>";
                }
            }
        } else {
            // Tratar erros na verificação, se necessário
            print "<script>alert('Erro na verificação de locações ativas!');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        }
        break;
    case 'finalizar':
    // Dados da locação
    $locacaoId = $_POST['id_locacao'];
    $dataDevolucaoReal = $_POST['data_devolucao_real'];
    $multa = $_POST['valor_multa'];
    $total = $_POST['valor_final'];
    $observacoesFinais = $_POST['observacoes_finais'];

    // Consulta para obter informações da locação
    $sqlLocacao = "SELECT * FROM locacao WHERE id = '$locacaoId'";
    $resLocacao = $conn->query($sqlLocacao);

    if ($resLocacao->num_rows > 0) {
        $rowLocacao = $resLocacao->fetch_object();

        // Obtém o ID do livro alugado
        $livroId = $rowLocacao->livro_id;

        // Atualiza a locação
        $sqlAtualizarLocacao = "UPDATE locacao SET
                                    dataDevolucaoReal = '$dataDevolucaoReal',
                                    valorMulta = '$multa',
                                    valorFinal = '$total',
                                    observacoesFinais = '$observacoesFinais',
                                    status_locacao_id = 2
                                WHERE
                                    id = '$locacaoId'";
        $resAtualizarLocacao = $conn->query($sqlAtualizarLocacao);

        // Atualiza a quantidade de exemplares do livro (incrementa +1)
        $sqlIncrementExemplares = "UPDATE livro SET qtdExemplares = qtdExemplares + 1 WHERE id = '$livroId'";
        $conn->query($sqlIncrementExemplares);

        // Verificar se a atualização foi bem-sucedida
        if ($resAtualizarLocacao) {
            print "<script>alert('Locação finalizada com sucesso!');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        } else {
            print "<script>alert('Não foi possível finalizar a locação!');</script>";
            print "<script>location.href='?page=locacao_listar';</script>";
        }
    } else {
        print "<script>alert('Locação não encontrada!');</script>";
    }

    break;

    case 'excluir':
        $idLocacao = $_REQUEST['id_locacao'];
        $sqlLocacao = "SELECT dataLocacao, livro_id FROM locacao WHERE id = $idLocacao";
    
        $resLocacao = $conn->query($sqlLocacao);
    
        if ($resLocacao) {
            $rowLocacao = $resLocacao->fetch_object();
            $dataLocacao = $rowLocacao->dataLocacao;
            $livroId = $rowLocacao->livro_id;
    
            $dataAtual = date('Y-m-d');
    
            if (strtotime($dataAtual) <= strtotime($dataLocacao)) {
                // O dia atual é igual ou inferior à dataLocacao, permitir exclusão
                $deleteLocacaoSql = "DELETE FROM locacao WHERE id = $idLocacao";
                $resExclusao = $conn->query($deleteLocacaoSql);
    
                if ($resExclusao) {
                    // Incremento +1 na qtdExemplares do livro
                    $sqlIncrementExemplares = "UPDATE livro SET qtdExemplares = qtdExemplares + 1 WHERE id = '$livroId'";
                    $conn->query($sqlIncrementExemplares);
    
                    print "<script>alert('Locação cancelada com sucesso!');</script>";
                } else {
                    print "<script>alert('Não foi possível cancelar a locação!');</script>";
                }
            } else {
                // O dia atual é superior à dataLocacao, mostrar mensagem de erro
                print "<script>alert('Não é permitido cancelar locações com datas de locação passadas.');</script>";
            }
        } else {
            // Trate o caso em que a consulta falhou
            echo "Erro ao executar a consulta: " . $conn->error;
        }
    
        // ... (seu código existente)
    
        break;
    

    default:
        # code...
        break;
}
