<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $sql = "INSERT INTO leitor (nome, telefone, dataNascimento) VALUES (
            '" . $_POST['nome_leitor'] . "',
            '" . $_POST['telefone_leitor'] . "',
            '" . $_POST['data_nascimento_leitor'] . "'
        )";

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Leitor cadastrado com sucesso!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar o leitor!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        }
        break;
    case 'editar':
        $sql = "UPDATE leitor SET 
            nome = '" . $_POST['nome_leitor'] . "', 
            telefone = '" . $_POST['telefone_leitor'] . "', 
            dataNascimento = '" . $_POST['data_nascimento_leitor'] . "'
            WHERE id = " . $_POST['id_leitor'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Leitor atualizado com sucesso!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        } else {
            print "<script>alert('Não foi possível atualizar o leitor!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        }
        break;
    case 'excluir':
        // Verifique se existem relacionamentos antes de excluir
        $sqlRelacionamento = "SELECT * FROM locacao WHERE leitor_id = " . $_REQUEST['id_leitor'];
        $resRelacionamento = $conn->query($sqlRelacionamento);

        if ($resRelacionamento->num_rows > 0) {
            print "<script>
                if (confirm('Existem locações associadas a este leitor. Excluir mesmo assim?')) {
                    location.href='?page=leitor_salvar&acao=excluir_confirmado&id_leitor=" . $_REQUEST['id_leitor'] . "';
                } else {
                    location.href='?page=leitor_listar';
                }
            </script>";
        } else {
            // Se não houver locações associadas, exclua diretamente
            $sqlExcluir = "DELETE FROM leitor WHERE id = " . $_REQUEST['id_leitor'];
            $resExcluir = $conn->query($sqlExcluir);

            if ($resExcluir == true) {
                print "<script>alert('Leitor excluído com sucesso!');</script>";
                print "<script>location.href='?page=leitor_listar';</script>";
            } else {
                print "<script>alert('Não foi possível excluir o leitor.');</script>";
                print "<script>location.href='?page=leitor_listar';</script>";
            }
        }
        break;
    case 'excluir_confirmado':
        // Exclua diretamente, pois o usuário confirmou a exclusão
        $sqlExcluir = "DELETE FROM leitor WHERE id = " . $_REQUEST['id_leitor'];
        $resExcluir = $conn->query($sqlExcluir);

        if ($resExcluir == true) {
            print "<script>alert('Leitor excluído com sucesso!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        } else {
            print "<script>alert('Não foi possível excluir o leitor!');</script>";
            print "<script>location.href='?page=leitor_listar';</script>";
        }
        break;
}
