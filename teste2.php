
<?php
include('index.php');
?>


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
