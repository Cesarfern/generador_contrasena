<?php 

 include 'conexion.php';

$consulta = $mysqli->query("SELECT SUM(Minimo_caracteres) AS minimo FROM generador_contrasena");
$fila = $consulta->fetch_assoc();

$minimo = $fila['minimo'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generador contraseñas</title>
</head>
<body>
  <form action="peticion.php" method="post" id="generador">
    <label>Logitud de contraseña (mínimo <?php echo $minimo; ?>)</label>
    <input type="hidden" id="minimo" value="<?php echo $minimo;?>">
    <input type="text" name="longitud" id="long" required>
    <input type="submit">
  </form>

  <input type="text" id="resultado" value="" style="width:2500px; border: none;">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/javascript">

    var generador=$('#generador');
    generador.submit(function (e) {
      e.preventDefault();
      var data=new FormData(this);
      $.ajax({
        url: generador.attr('action'),
        type: generador.attr('method'),
        data:  data,
        success: function(response) {
          console.log(response);
          var resultado = response.slice(1);
          var resultado = resultado.slice(0, -1);
          $('#resultado').val(resultado);
        },
        error: function(response) {
          console.log(response);
        },
        processData: false,
        contentType: false
      });      
    });
  </script>
</body>
</html>