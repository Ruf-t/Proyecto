
<link rel="stylesheet" href="../resources/style.css">

<body id="body-home">   
    <main>
        <?php
        include '../header.php';
        include '../BaseDatos/functions.php';
        $datos_viaje = datos_tabla_viaje($con);
        ?>
        
        <div class="div-panel-administracion">
            <h3>Panel de administracion</h3>
            <div class="div-botones-administracion">
                <button><img src="../resources/img/Iconos-SVG/icons-others/folder-open-blue.svg">Ordenes Totales<img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                <button><img src="../resources/img/Iconos-SVG/icons-others/folder-open-red.svg">Ganancias Totales<img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                <button><img src="../resources/img/Iconos-SVG/icons-others/folder-open-orange.svg">Taxis<img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
            </div>
        </div>
        <section class="div-taxistas-mes">
            <h3>Taximetristas del mes<img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></h3>
            <div>
                <img src="../resources/img/Logos-PNG/Avatar/A2.png">
                <div>    
                    <p class="nombre-taxistas-mes">Maharrm Hasanli</p>
                    <p class="num-taxistas-mes">+598 92112906</p>
                </div>
            </div>
            <div>
                <img src="../resources/img/Logos-PNG/Avatar/A4.png">
                <div>
                    <p class="nombre-taxistas-mes">Gina Garza</p>
                    <p class="num-taxistas-mes">+598 92112906</p>
                </div>
            </div>
            <div>
                <img src="../resources/img/Logos-PNG/Avatar/A5.png">
                <div>
                    <p class="nombre-taxistas-mes">Brian Reed</p>
                    <p class="num-taxistas-mes">+598 92112906</p>
                </div>
            </div>
        </section>


        <div class="div-tabla-panel">
            <table id="table-panel">
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
                <tbody>
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
            <nav><span>
                <a href="home.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/home.svg"><span id="home_menu">Panel</span></a>
                <a href="viajes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/bookmark.svg"><span id="viajes_menu">Viajes</span></a>
                <a href="clientes.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/cliente.svg"><span id="clientes_menu">Clientes</span></a>
                <a href="taxistas.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/driver.svg"><span id="taxistas_menu">Taxistas</span></a>
                <a href="ingresos.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/ingresos.svg"><span id="ingresos_menu">Ingresos</span></a>
                <a href="taxis.php" class="a-menu"><img src="../resources/img/Iconos-SVG/white/taxi.svg"><span id="taxis_menu">Taxis</span></a>
                <a href="configuracion.php" class="a-menu btn-config"><img src="../resources/img/Iconos-SVG/white/setting.svg"><span id="config_menu">Configuracion</span></a>
            </nav>
        </div>
    </div>
    
    <script src="../resources/script.js"></script>
</body>
</html>