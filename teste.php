<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtros</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="container mt-5">

    <div class="form-group">
        <label for="ano">Selecione o Ano:</label>
        <select class="form-control" id="ano" name="ano">
            <!-- Adicione opções para os anos -->
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </div>

    <div class="form-group">
        <label for="mes">Selecione o Mês:</label>
        <select class="form-control" id="mes" name="mes">
            <!-- Adicione opções para os meses -->
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </div>

    <button class="btn btn-primary" onclick="filtrar()">Filtrar</button>

    <script>
        function filtrar() {
            // Obter valores selecionados
            var anoSelecionado = document.getElementById("ano").value;
            var mesSelecionado = document.getElementById("mes").value;

            // Implemente aqui a lógica para filtrar os dados no seu site
            // Você pode usar esses valores para enviar uma solicitação ao servidor ou manipular os elementos na página.

            // Exemplo de impressão no console (substitua por sua lógica real)
            console.log("Ano selecionado: " + anoSelecionado);
            console.log("Mês selecionado: " + mesSelecionado);
        }
    </script>




<div class="container mt-5">
  <h2>Barra de Progresso Dinâmica</h2>
  
  <div id="progress-container" class="progress">
    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
  </div>

  <button id="start-button" onclick="simularProcessoAssincrono()">Iniciar Processo Assíncrono</button>
</div>

<script>
  function simularProcessoAssincrono() {
    var progressContainer = document.getElementById('progress-container');
    var progressBar = document.getElementById('progress-bar');
    var startButton = document.getElementById('start-button');
    var valorAtual = 0;

    var temporizador = setInterval(function() {
      // Simule um processo assíncrono incrementando o valor atual
      valorAtual += 10;
      
      // Atualize a barra de progresso
      progressBar.style.width = valorAtual + '%';
      progressBar.setAttribute('aria-valuenow', valorAtual);

      // Verifique se o processo está concluído
      if (valorAtual >= 100) {
        clearInterval(temporizador);

        // Quando o processo terminar, ocultar a barra de progresso e o botão
        progressContainer.style.display = 'none';
        startButton.style.display = 'none';
      }
    }, 1000); // Atualiza a cada 1 segundo (simulando um processo assíncrono)
  }
</script>

<div class="container mt-5">
    <h2>Formulário de Contato</h2>

    <form action="#" method="post">

      <div class="form-row">
        <div class="form-group col-md-2">
          <label for="ddd">DDD:</label>
          <input type="text" class="form-control" id="ddd" name="ddd" pattern="\d{2}" placeholder="DDD" required>
        </div>

        <div class="form-group col-md-10">
          <label for="numero">Número:</label>
          <input type="text" class="form-control" id="numero" name="numero" pattern="\d{8,9}" placeholder="Número" required>
        </div>
      </div>
      
      <div class="form-group">
        <label for="tipoTelefone">Tipo de Telefone:</label>
        <select class="form-control" id="tipoTelefone" name="tipoTelefone" required>
          <option value="fixo">Fixo</option>
          <option value="movel">Móvel</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

  </div>
  </div>

  <div class="container mt-5">
  <h2>Seleção de Data</h2>
  
  <div class="form-group">
    <label for="data1">Selecione a primeira data:</label>
    <input type="date" class="form-control" id="data1">
  </div>
  
  <div class="form-group">
    <label for="data2">Selecione a segunda data (apenas dias após a primeira data):</label>
    <input type="date" class="form-control" id="data2" disabled>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Obter referências aos elementos de data
  var data1 = document.getElementById('data1');
  var data2 = document.getElementById('data2');

  // Adicionar um ouvinte de evento para o campo de data1
  data1.addEventListener('input', function () {
    // Habilitar o campo de data2
    data2.disabled = false;

    // Obter a data selecionada no campo de data1
    var dataSelecionada1 = new Date(data1.value);

    // Calcular a data mínima para o campo de data2
    var dataMinima2 = new Date(dataSelecionada1);
    dataMinima2.setDate(dataMinima2.getDate() + 1); // Adicionar 1 dia

    // Configurar a data mínima para o campo de data2
    data2.min = dataMinima2.toISOString().split('T')[0];
  });
});
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<select class="js-example-responsive form-control" style = "height:200%" name="state">
  <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option>
</select>

<div style = "margin-top:100px;"></div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-responsive').select2({
    });
});
</script>
</body>
</html>
