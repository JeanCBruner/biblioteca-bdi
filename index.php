<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    label {
      font-weight: bold;
    }
  </style>

  <title>Biblioteca</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Editoras
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?page=editora_listar">Listar</a>
            <a class="dropdown-item" href="?page=editora_cadastrar">Cadastrar</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categorias
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?page=categoria_listar">Listar</a>
            <a class="dropdown-item" href="?page=categoria_cadastrar">Cadastrar</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Livros
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?page=livro_listar">Listar</a>
            <a class="dropdown-item" href="?page=livro_cadastrar">Cadastrar</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Locação
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="?page=locacao_cadastrar">Realizar</a>
          </div>
        </li>
      </ul>
      <!--
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      -->
      </form>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col">
        <?php
        //conexão com o BD
        include('config.php');

        //includes das páginas
        switch (@$_REQUEST['page']) {
            // EDITORAS
          case 'editora_listar':
            include('editora_listar.php');
            break;
          case 'editora_cadastrar':
            include('editora_cadastrar.php');
            break;
          case 'editora_editar':
            include('editora_editar.php');
            break;
          case 'editora_salvar':
            include('editora_salvar.php');
            break;
            // CATEGORIAS
          case 'categoria_listar':
            include('categoria_listar.php');
            break;
          case 'categoria_cadastrar':
            include('categoria_cadastrar.php');
            break;
          case 'categoria_editar':
            include('categoria_editar.php');
            break;
          case 'categoria_salvar':
            include('categoria_salvar.php');
            break;
            // LIVROS
          case 'livro_listar':
            include('livro_listar.php');
            break;
          case 'livro_cadastrar':
            include('livro_cadastrar.php');
            break;
          case 'livro_editar':
            include('livro_editar.php');
            break;
          case 'livro_salvar':
            include('livro_salvar.php');
            break;
            case 'locacao_cadastrar':
              include('locacao_cadastrar.php');
              break;
              case 'locacao_salvar':
                include('locacao_salvar.php');
                break;
          default:
            print "<h1> Seja bem vindo! </h1>";
        }
        ?>
      </div>
    </div>
  </div>
  

</body>

</html>