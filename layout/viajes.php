<?php
// session_start();
//     if (!isset($_SESSION['user'])) {
//         header("Location: ../Register-Login/index.php");
//         exit;
//     }
?>
<link rel="stylesheet" href="../resources/style.css">
<body id="body-home">
    <main>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_viaje = datos_tabla_viaje($con);
        ?>

        <div class="btn-select-turno-fecha">
            <div class="selects">
                <select id="turno">
                    <option value="">Selecciona un turno</option>
                    <option value="Turno 1">Turno 1</option>
                    <option value="Turno 2">Turno 2</option>
                </select>

                <select id="fecha">
                    <option value="">Selección de fechas</option>
                    <option value="hoy">Hoy</option>
                    <option value="un_dia">Hace un día</option>
                    <option value="semana">Esta semana</option>
                    <option value="mes">Este mes</option>
                    <option value="seis_meses">Últimos 6 meses</option>
                    <option value="personalizada">Fecha personalizada</option>
                </select>
                <button id="recargar-tabla"><img src="../resources/img/Iconos-SVG/icons-others/refresh.svg"></button>
            </div>
        </div>
        <div class="div-tabla-viaje">
            <table id="tabla-viaje">
                <thead>
                    <tr>
                        <th>Taximetrista</th>
                        <th>Cliente</th>
                        <th>Matricula Coche</th>
                        <th>Fecha Viaje</th>
                        <th>Metodo de pago</th>
                        <th>Ingreso</th>
                    </tr>
                </thead>
                <tbody id="viajes-body">
                <?php foreach ($datos_viaje as $fila) { ?>
                    <tr>
                        <td><?php echo $fila['Nombre_Taxista']; ?></td>
                        <td><?php echo $fila['Nombre_Cliente'];?></td> 
                        <td><?php echo $fila['matricula']; ?></td>    
                        <td><?php echo $fila['Fecha']; ?></td>    
                        <td><?php echo $fila['Método_de_pago']; ?></td>    
                        <td><?php echo $fila['Tarifa']; ?></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
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
                <a href="configuracion.php" class="a-menu btn-config"><img src="../resources/img/Iconos-SVG/white/setting.svg">Configuracion</a>
            </nav>
        </div>
    </div>
    
    <script src="../resources/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../resources/ajax.js"></script>
</body>
</html>