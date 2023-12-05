<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $sql = "INSERT INTO livro (nome, autor, anoPublicacao, qtdExemplares, editora_id, categoria_id) VALUES (
            '" . $_POST['nome_livro'] . "', 
            '" . $_POST['nome_autor'] . "',
            '" . $_POST['ano_publicacao'] . "',
            '" . $_POST['qtd_exemplares'] . "', 
            " . $_POST['editora_id_editora'] . ",
            " . $_POST['categoria_id_categoria'] . "
        )";
        

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Livro cadastrado com sucesso!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        }
        break;
    case 'editar':
        $sql = "UPDATE livro SET
                    editora_id = " . $_POST['editora_id_editora'] . ",
                    categoria_id = '" . $_POST['categoria_id_categoria'] . "',
                    nome = '" . $_POST['nome_livro'] . "',
                    autor = '" . $_POST['nome_autor'] . "',
                    anoPublicacao = '" . $_POST['ano_publicacao'] . "',
                    qtdExemplares = '" . $_POST['qtd_exemplares'] . "'
                 WHERE
                    id = " . $_POST['id_livro'];



        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Livro atualizado com sucesso!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        } else {
            print "<script>alert('Não foi possível atualizar!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        }
        break;
    case 'excluir':
        $sql = "DELETE FROM livro WHERE id = " . $_REQUEST['id_livro'];

        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Livro excluido com sucesso!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        } else {
            print "<script>alert('Não foi possível excluir!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
        }
        break;
    default:
        # code...
        break;
}
