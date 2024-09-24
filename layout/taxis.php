<?php
// session_start();
//     if (!isset($_SESSION['user'])) {
//         header("Location: ../Register-Login/index.php");
//         exit;
//     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <!-- <link rel="icon" href="../../resources/img/Others/Favicon-Ruft.png" type="image/png"> -->
    <link rel="stylesheet" href="../resources/style.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../resources/ajax.js"></script>

</head>

<body id="body-home">
    <main>
    <div id="resultado"></div>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_taxis = mostrar_datos_taxis($con);
        ?>

        <div class="div-addTaxi">
            <h1>Lista de Taxis</h1>
            <button class="btn-abrir-modal  boton-add-Taxi">Añadir Taxi</button>
        </div>

        <div class="tabla-Taxis">
            <table>
                <thead> 
                    <tr class="columnas-tabla-Taxis">
                        <th>N° Taxi</th>
                        <th>Kilometros</th>
                        <th>Año</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Proximo Servicio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($datos_taxis as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['ID']; ?></td>
                            <td><?php echo $fila['Matricula']; ?></td>
                            <td><?php echo $fila['Modelo']; ?></td>
                            <td><?php echo $fila['Año']; ?></td>
                            <td><?php echo $fila['Estado']; ?></td>
                            <td></td>
                            <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera" onclick="eliminarTaxi(<?php echo $fila['ID']; ?>)"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="div-cantidad-Taxis">
                <h3 class="total-Taxis">Total de Taxis: $5</h3>
                <div class="div-paginas">
                    <button class="pasar-paginas" onclick="activarBoton('1')"><img src="../resources/img/Iconos-SVG/icons-others/flecha-menorque.svg"></button>
                    <button class="paginas active" onclick="cambioColorBoton(this)">1</button>
                    <button class="paginas" >2</button>
                    <button class="pasar-paginas" onclick="activarBoton('2')"><img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                </div>
            </div>
        </div>  
    </main>

    <div class="sidebar-container">
        <div class="div-usuario">
            <h1 class="user-name">Usuario</h1>
            <p class="user-num">+598 92112906</p>
        </div>
        <div class="menu-container">
            <nav>
                <a href="home.php" class="a-menu">
                    <img src="../resources/img/Iconos-SVG/white/home.svg">Panel
                </a>
                <a href="viajes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/bookmark.svg">Viajes</a>
                <a href="clientes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/cliente.svg">Clientes</a>
                <a href="taxistas.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/driver.svg">Taximetristas</a>
                <a href="ingresos.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/ingresos.svg">Ingresos</a>
                <a href="taxis.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/taxi.svg">Taxis</a>
            </nav>
        </div>
        <div class="config-container">
            <nav>
                <a href="configuracion.php" class="a-menu">
                    <img src="../resources/img/Iconos-SVG/white/setting.svg">Configuracion</a>
            </nav>
        </div>
    </div>
    
    <dialog class="modal">
            <div>
                <h2>Agregar Nuevo Taxi</h2>
            </div>
            <form id="form-add-taxi" class="formulario" method="post">
                <label>Matricula<input type="text" name="matricula" id="matricula"></label>
                <label>Modelo<input type="text" name="modelo" id="modelo"></label>
                <label>Año<input type="number" name="anio" id="anio"></label>
                <label>Estado (Activo o Pasivo)</label>
                    <select name="estadoNuevoTaxi" id="estadoNuevoTaxi">
                    <option value="">Selecciona un estado</option>
                    <option value="1">Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
                <button type="submit">Añadir</button>
            </form>
            <button class="btn-cerrar-modal" type="button">Cerrar modal</button>
        </dialog>
    
     <!---- importacion de jquery---->
     <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
     <script src="../resources/script.js"></script>
</body>
</html>