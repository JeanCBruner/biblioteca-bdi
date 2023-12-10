<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $sql = "INSERT INTO categoria (nome, descricao) VALUES ('".$_POST['nome_categoria']."', '".$_POST['descricao_categoria']."')";

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Categoria cadastrada com sucesso!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        }
        break;
    case 'editar':
        $sql = "UPDATE categoria SET nome = '".$_POST['nome_categoria']."', descricao = '".$_POST['descricao_categoria']."' WHERE id = ".$_POST['id_categoria'];

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Categoria atualizada com sucesso!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        } else {
            print "<script>alert('Não foi possível atualizar!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        }
        break;
    case 'excluir':
        $sql = "DELETE FROM categoria WHERE id = ".$_REQUEST['id_categoria'];

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Categoria excluida com sucesso!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        } else {
            print "<script>alert('Não foi possível excluir!');</script>";
            print "<script>location.href='?page=categoria_listar';</script>";
        }
        break;
}
