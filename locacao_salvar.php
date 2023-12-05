<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':

        $sql = "INSERT INTO alocacao (dataAlocacao, dataDevolucaoEstimada, observacoes, livro_id, leitor_id, status_alocacao_id) VALUES (
            '" . $_POST['data_locacao'] . "', 
            '" . $_POST['data_devolucaoE'] . "',
            '" . $_POST['observacao'] . "',
            '" . $_POST['livro_id_livro'] . "', 
            " . $_POST['leitor_id_leitor'] . ",
            '1'
        )";
        

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Locação realizada com sucesso!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        } else {
            print "<script>alert('Não foi possível realizar a operação!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        }
        break;
    case 'editar':

        break;
    case 'excluir':

        break;
    default:
        # code...
        break;
}
