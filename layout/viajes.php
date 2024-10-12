
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
                    <option value="" id="option_select_turno"></option>
                    <option value="1" id="option_select_turno1"></option>
                    <option value="2" id="option_select_turno2"></option>
                </select>

                <select id="fecha">
                    <option value="" id="option_select_fecha"></option>
                    <option value="hoy" id="option_select_fecha_hoy"></option>
                    <option value="un_dia" id="option_select_fecha_1dia"></option>
                    <option value="semana" id="option_select_fecha_semana"></option>
                    <option value="mes" id="option_select_fecha_mes"></option>
                    <option value="seis_meses" id="option_select_fecha_6meses"></option>
                    <option value="personalizada" id="option_select_fecha_personalizada"></option>
                </select>
                <button id="recargar-tabla"><img src="../resources/img/Iconos-SVG/icons-others/refresh.svg"></button>
            </div>
        </div>
        <div class="div-tabla-viaje">
            <table id="tabla-viaje">
                <thead>
                    <tr>
                        <th id="th_taxista"></th>
                        <th id="th_cliente"></th>
                        <th id="th_matricula"></th>
                        <th id="th_fecha"></th>
                        <th id="th_metodo_pago"></th>
                        <th id="th_ingreso"></th>
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
            <img src="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-7B.svg">
        </div>
        <div class="menu-container"> 
            <nav>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../resources/ajax.js"></script>
</body>
</html>