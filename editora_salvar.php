<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        $sql = "INSERT INTO editora (nome) VALUES ('".$_POST['nome_editora']."')";

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Editora cadastrada com sucesso!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        } else {
            print "<script>alert('Não foi possível cadastrar!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        }
        break;
    case 'editar':
        $sql = "UPDATE editora SET nome = '".$_POST['nome_editora']."' WHERE id = ".$_POST['id_editora'];

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Editora atualizada com sucesso!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        } else {
            print "<script>alert('Não foi possível atualizar!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        }
        break;
    case 'excluir':
        $sql = "DELETE FROM editora WHERE id = ".$_REQUEST['id_editora'];

        $res = $conn->query($sql);

        if ($res==true) {
            print "<script>alert('Editora excluida com sucesso!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        } else {
            print "<script>alert('Não foi possível excluir!');</script>";
            print "<script>location.href='?page=editora_listar';</script>";
        }
        break;
}
