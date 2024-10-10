<?php
include("/xampp/htdocs/Proyecto/BaseDatos/functions.php");

// session_start();
    if (!isset($_SESSION['userTaxi'])) {
        header("Location: index-Taximetrista.php");
        exit;
    }
    $userTaxi = $_SESSION['userTaxi'];

 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="icon" href="../../resources/img/Others/Favicon-Ruft.png" type="image/png">
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
<div class="respuestaAJAX">
    <p class="mensajeAJAX"></p>
</div>


    <?php include 'header-Taximetrista.php'; ?>

  <!-- Botón select -->
<button class="selectButton" id="btnIniciarJornada" data-target="formContainer1">Iniciar Turno <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>

<!-- Contenedor de Iniciar Jornada -->
<div id="formContainer1" class="hidden">
  <form id="formIniciarJornada" method="post" class="formulario">
      <p>Km inicial</p>
      <input type="number" name="KmInicialTaximetrista" id="KmInicialTaximetrista" required  min="1">
      
      <p>Número de coche</p>
      <!-- <label for="NumeroDeCocheTaximetrista">Selecciona la matrícula del taxi:</label> -->
      <select name="NumeroDeCocheTaximetrista" id="NumeroDeCocheTaximetrista" required placeholder="selecciona una opcion">
          <option value="">--Selecciona una matrícula--</option>
         <?php 
         // Este PHP debe obtener las matrículas del taxi desde la base de datos.
         $matriculas = obtenerMatrículasTaxis($con);
         foreach ($matriculas as $matricula): ?>
                <option value="<?php echo $matricula['ID']; ?>">
                    <?php echo $matricula['Matricula']; ?>
                </option>
            <?php endforeach; ?>
      </select>
      <button type="submit">Guardar</button>
  </form>    
</div>

<!-- Botón para iniciar viaje -->
<button class="selectButton" id="btnIniciarViaje" data-target="formContainer2" disabled>Registrar Viaje <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>
<!-- Contenedor de Iniciar Viaje -->
<div id="formContainer2" class="hidden">
  <form id="formIniciarViaje" method="post" class="formulario">
      <p>Costo</p>
      <input type="number" name="CostoViajeTaximetrista" id="CostoViajeTaximetrista" placeholder="Coloca el importe" required  min="1">
      <p>Metodo de pago</p>
      <select name="MetodoDePagoTaximetrista" id="MetodoDePagoTaximetrista" required>
          <option value="">Seleccione un método de pago</option>
          <option value="efectivo">Efectivo</option>
          <option value="tarjeta">Tarjeta</option>
          <option value="transferencia">Transferencia bancaria</option>
      </select>
      <p>Ingresa el nombre del cliente (Si es que esta registrado)</p>
    <select name="ClienteViajeTaximetrista" id="ClienteViajeTaximetrista">
    <option value="">--Selecciona un cliente--</option>
    
    <?php $clientes = obtenerClientesRegistrados($con); 
    foreach ($clientes as $cliente): ?>
        <option value="<?php echo $cliente['ClienteID']; ?>">
            <?php echo $cliente['Nombre']; ?>
        </option>
    <?php endforeach; ?>
</select>
      <button type="submit" name="envioViajeTaximetrista">Guardar</button>
  </form>    
</div>

<!-- Botón para finalizar jornada -->
<button class="selectButton" id="btnFinalizarJornada" data-target="formContainer3" disabled>Finalizar Turno <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>

<!-- Contenedor de Terminar Jornada -->
<div id="formContainer3" class="hidden">
  <form id="formFinalizarJornada" method="post" class="formulario">
      <p>Km final</p>
      <input type="number" name="KmFinalTaximetrista" id="KmFinalTaximetrista" placeholder="Ingresa el Km final de la jornada" required  min="1">
      <button type="submit" name="envioFinalizarJornadaTaximetrista">Guardar</button>
  </form>    
</div>

<div class="div-cambiar-idioma-taxistas">
    <button id="switch_idioma">cambiar idioma</button>
</div>


    <script src="/proyecto/resources/script.js"></script>
    <script src="../resources-Taximetristas/script-idioma.js"></script>
    <script src="../resources-Taximetristas/ajax-taximetrista.js"></script>
    <!---- importacion de jquery---->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>
