<?php
include("/xampp/htdocs/Proyecto/BaseDatos/functions.php");

session_start();
    if (!isset($_SESSION['userTaxi'])) {
        header("Location: index-Taximetrista.php");
        exit;
    }
    $userTaxi = $_SESSION['userTaxi'];

        if (isset($_POST['envioIniciarJornadaTaximetrista'])) {
            // Obtener datos del formulario
            $KmInicialTaximetrista = $_POST['KmInicialTaximetrista'];
            $NumeroDeCocheTaximetrista = $_POST['NumeroDeCocheTaximetrista'];

            FormJornadaUserTaxis($con, $KmInicialTaximetrista, $NumeroDeCocheTaximetrista);
        } 

        if (isset($_POST['envioViajeTaximetrista'])) {
            // Obtener datos del formulario
            $CostoViajeTaximetrista = $_POST['CostoViajeTaximetrista'];
            $MetodoDePagoTaximetrista = $_POST['MetodoDePagoTaximetrista'];
            $ClienteViajeTaximetrista = $_POST['ClienteViajeTaximetrista'];
            $TaximetristaUser = $_SESSION['userTaxi'];
            // $NumeroDeCocheTaximetrista = $_SESSION['NumeroDeCocheTaximetrista'];


            FormInciarViajeUserTaxis($con, $CostoViajeTaximetrista,$MetodoDePagoTaximetrista,$ClienteViajeTaximetrista,$TaximetristaUser);
        }    
        
        if (isset($_POST['envioFinalizarJornadaTaximetrista'])) {
            // Obtener datos del formulario
            $KmFinalTaximetrista = $_POST['KmFinalTaximetrista'];
            $TaximetristaUser = $_SESSION['userTaxi'];
            // $NumeroDeCocheTaximetrista = $_POST['NumeroDeCocheTaximet';
            FormTerminarJornadaUserTaxis($con, $TaximetristaUser, $KmFinalTaximetrista);
        }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="icon" href="../../resources/img/Others/Favicon-Ruft.png" type="image/png">
    <link rel="stylesheet" href="../style/style-Taximetristas.css">
</head>

<body>
        <?php
        include 'header-Taximetrista.php';
        ?>
    
    <!-- Botón select -->
    <button class="selectButton" data-target="formContainer1">Iniciar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>
    <!-- Contenedor de Iniciar Jornada -->
    <div id="formContainer1" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Km inicial</p>
        <input type="number" name="KmInicialTaximetrista" id="KmInicialTaximetrista" placeholder="" required>
        <p>Número de coche</p>
        <?php $matriculas = obtenerMatrículasTaxis($con);?>

        <label for="NumeroDeCocheTaximetrista">Selecciona la matrícula del taxi:</label>
        <select name="NumeroDeCocheTaximetrista" id="NumeroDeCocheTaximetrista" required>
            <option value="">--Selecciona una matrícula--</option>
            <?php foreach ($matriculas as $matricula): ?>
                <option value="<?php echo $matricula['ID']; ?>">
                    <?php echo $matricula['Matricula']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="envioIniciarJornadaTaximetrista">Guardar</button>
    </form>    
    </div>


    <button class="selectButton" data-target="formContainer2">Iniciar viaje<img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>
    <!-- Contenedor de Iniciar Viaje -->
    <div id="formContainer2" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Costo</p>
        <input type="number" name="CostoViajeTaximetrista" id="CostoViajeTaximetrista" placeholder="" required>
        <p>Metodo de pago</p>
        <select name="MetodoDePagoTaximetrista" id="MetodoDePagoTaximetrista" required>
        <option value="">Seleccione un método de pago</option>
        <option value="efectivo">Efectivo</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="transferencia">Transferencia bancaria</option>
    </select>
    <p>Ingresa el nombre del cliente (Si es que esta registrado)</p>
    <select name="ClienteViajeTaximetrista" id="ClienteViajeTaximetrista" >
    <option value="">--Selecciona un cliente--</option>
    
    <?php 
    $clientes = obtenerClientesRegistrados($con); 
    foreach ($clientes as $cliente): ?>
        <option value="<?php echo $cliente['ClienteID']; ?>">
            <?php echo $cliente['Nombre']; ?>
        </option>
    <?php endforeach; ?>
</select>

        
    <button type="submit" name="envioViajeTaximetrista">Guardar</button>
    </form>    
    </div>


    <button class="selectButton" data-target="formContainer3">Finalizar Jornada <img src="../../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg" alt="" id="flecha"></button>

    <!-- Contenedor de Terminar Jornada -->
    <div id="formContainer3" class="hidden">
    <form action="home-Taximetrista.php" method="post" class="formulario">
        <p>Km final</p>
        <input type="number" name="KmFinalTaximetrista" id="KmFinalTaximetrista" placeholder="Ingresa el Km final de la jornada" required>
        <button type="submit" name="envioFinalizarJornadaTaximetrista">Guardar</button>
    </form>    
    </div>

    <script src="/proyecto/resources/script.js"></script>
    </body>

</html>