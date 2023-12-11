<?php

switch ($_REQUEST['acao']) {
    case 'cadastrar':
        // Dados do livro
        $nomeLivro = $_POST['nome_livro'];
        $nomeAutor = $_POST['nome_autor'];
        $anoPublicacao = $_POST['ano_publicacao'];
        $qtdExemplares = $_POST['qtd_exemplares'];
        $editoraId = $_POST['editora_id_editora'];

        // Criação do livro
        $sqlLivro = "INSERT INTO livro (nome, autor, anoPublicacao, qtdExemplares, editora_id) VALUES (
            '$nomeLivro',
            '$nomeAutor',
            '$anoPublicacao',
            '$qtdExemplares',
            '$editoraId'
        )";

        $resLivro = $conn->query($sqlLivro);

        // ID do livro inserido
        $livroId = $conn->insert_id;

        // Categorias selecionadas
        $categoriasSelecionadas = isset($_POST['categoria_id_categoria']) ? $_POST['categoria_id_categoria'] : [];

        $resCategoria = true;  // Inicializa a variável $resCategoria

        foreach ($categoriasSelecionadas as $categoriaId) {
            $sqlCategoria = "INSERT INTO livro_categoria (livro_id, categoria_id) VALUES ('$livroId', '$categoriaId')";
            $resCategoria = $conn->query($sqlCategoria);

            // Lidere com $resCategoria conforme necessário
        }

        // Verifique o resultado da inserção do livro e categorias
        if ($resLivro && $resCategoria) {
            print "<script>alert('Livro cadastrado com sucesso!');</script>";
            print "<script>location.href='?page=livro_listar';</script>";
            
        } else {
            print "<script>alert('Não foi possível cadastrar o livro!');</script>";
            print "<script>location.href='?page=livro_cadastrar';</script>";
            
        }
        break;

        case 'editar':
            // Dados do livro
            $livroId = $_POST['id_livro'];
            $nomeLivro = $_POST['nome_livro'];
            $nomeAutor = $_POST['nome_autor'];
            $anoPublicacao = $_POST['ano_publicacao'];
            $qtdExemplares = $_POST['qtd_exemplares'];
            $editoraId = $_POST['editora_id_editora'];
        
            // Atualização do livro
            $sqlLivro = "UPDATE livro SET
                            editora_id = '$editoraId',
                            nome = '$nomeLivro',
                            autor = '$nomeAutor',
                            anoPublicacao = '$anoPublicacao',
                            qtdExemplares = '$qtdExemplares'
                         WHERE
                            id = '$livroId'";
        
            $resLivro = $conn->query($sqlLivro);
        
            // Limpar as categorias antigas do livro
            $sqlLimparCategorias = "DELETE FROM livro_categoria WHERE livro_id = '$livroId'";
            $conn->query($sqlLimparCategorias);
        
            // Categorias selecionadas
            $categoriasSelecionadas = isset($_POST['categoria_id_categoria']) ? $_POST['categoria_id_categoria'] : [];
        
            // Inserção de categorias atualizadas na tabela de ligação (livro_categoria)
            foreach ($categoriasSelecionadas as $categoriaId) {
                $sqlCategoria = "INSERT INTO livro_categoria (livro_id, categoria_id) VALUES ('$livroId', '$categoriaId')";
                $conn->query($sqlCategoria);
            }
        
            // Verificar o resultado da atualização do livro e categorias
            if ($resLivro) {
                print "<script>alert('Livro atualizado com sucesso!');</script>";
                print "<script>location.href='?page=livro_listar';</script>";
            } else {
                print "<script>alert('Não foi possível atualizar o livro!');</script>";
                print "<script>location.href='?page=livro_listar';</script>";
            }
            break;
            case 'excluir':
                // Verificar se há dependências na tabela livro_categoria
                $checkDependenciesSql = "SELECT COUNT(*) as count FROM livro_categoria WHERE livro_id = " . $_REQUEST['id_livro'];
                $checkDependenciesResult = $conn->query($checkDependenciesSql);
                $dependencyCount = $checkDependenciesResult->fetch_object()->count;
            
                if ($dependencyCount > 0) {
                    // Se existirem categorias associadas, mostrar um alerta de confirmação
                    echo "<script>
                            if(confirm('Existem categorias associadas a este livro. 
                            Tem certeza de que deseja excluir? Isso removerá todas as associações de categorias.')) {
                                // Se confirmado, excluir associações de categorias
                                var livroId = " . $_REQUEST['id_livro'] . ";
                                window.location.href = '?page=livro_salvar&acao=excluir_categorias&id_livro=' + livroId;
                            } else {
                                window.location.href = '?page=livro_listar';
                            }
                          </script>";
                } else {
                    // Se não houver dependências, exclua o livro normalmente
                    $deleteLivroSql = "DELETE FROM livro WHERE id = " . $_REQUEST['id_livro'];
                    $res = $conn->query($deleteLivroSql);
            
                    if ($res == true) {
                        print "<script>alert('Livro excluído com sucesso!');</script>";
                        print "<script>location.href='?page=livro_listar';</script>";
                    } else {
                        print "<script>alert('Não foi possível excluir o livro!');</script>";
                        print "<script>location.href='?page=livro_listar';</script>";
                    }
                }
                break;
            
            case 'excluir_categorias':
                // Excluir associações de categorias
                $livroId = $_REQUEST['id_livro'];
                $deleteCategoriasSql = "DELETE FROM livro_categoria WHERE livro_id = " . $livroId;
                $resCategorias = $conn->query($deleteCategoriasSql);
            
                if ($resCategorias == true) {
                    // Após excluir as associações de categorias, exclua o livro
                    $deleteLivroSql = "DELETE FROM livro WHERE id = " . $livroId;
                    $resLivro = $conn->query($deleteLivroSql);
            
                    if ($resLivro == true) {
                        print "<script>alert('Livro e associações de categorias excluídos com sucesso!');</script>";
                        print "<script>location.href='?page=livro_listar';</script>";
                    } else {
                        print "<script>alert('Não foi possível excluir o livro!');</script>";
                        print "<script>location.href='?page=livro_listar';</script>";
                    }
                } else {
                    print "<script>alert('Não foi possível excluir as associações!');</script>";
                    print "<script>location.href='?page=livro_listar';</script>";
                }
                break;
            
    default:
        # code...
        break;
}
