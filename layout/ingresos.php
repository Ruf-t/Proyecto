<link rel="stylesheet" href="../resources/style.css">
<link rel="icon" href="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" type="image/png">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../resources/ajax.js"></script>

<body id="body-home">
    <main>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        // $jsonDatos = obtener_total_tarifas_por_todas_jornadas($con);
        // // Decodificamos el JSON para convertirlo en un array asociativo
        // $datos_res_jornada = json_decode($jsonDatos, true);

        $jsonDatosJornadas = obtener_informacion_jornadas($con);
        $datos_res_jornada = json_decode($jsonDatosJornadas, true); // true para obtener un array asociativo


        ?>
        <!-- <div class="btn-select-filtro">
            <h1 id="h1_ingresos"></h1>
            <div class="selects">
                <select id="fecha_I">
                        <option value="" id="option_select_fecha"></option>
                        <option value="hoy" id="option_select_fecha_hoy"></option>
                        <option value="un_dia" id="option_select_fecha_1dia"></option>
                        <option value="semana" id="option_select_fecha_semana"></option>
                        <option value="mes" id="option_select_fecha_mes"></option>
                        <option value="seis_meses" id="option_select_fecha_6meses"></option>
                        <option value="personalizada" id="option_select_fecha_personalizada"></option>
                </select>
                <button id="recargar-tabla-I"><img src="../resources/img/Iconos-SVG/icons-others/refresh.svg"></button>
            </div>
        </div> -->
        <div class="btn-select-filtro">
            <h1 id="h1_ingresos"></h1>
            <div class="selects">
                <select id="fecha_I">
                    <option value="">Seleccione una fecha</option>
                    <option value="hoy">Hoy</option>
                    <option value="un_dia">Último día</option>
                    <option value="semana">Última semana</option>
                    <option value="mes">Último mes</option>
                    <option value="seis_meses">Últimos 6 meses</option>
                </select>
            </div>
        </div>
        <div id="resultado"></div>
        <div class="div-tabla-ingresos">
            <table id="tabla-ingresos">
                <thead>
                    <tr>
                        <th id="th_numero_taxi"></th>
                        <th id="th_taxista"></th>
                        <th id="th_fecha"></th>
                        <th id="th_ingreso"></th>
                    </tr>
                </thead>
                <tbody id="jornadas-body">
                <?php foreach ($datos_res_jornada as $fila) { ?>
                            <tr>
                                <td><?php echo $fila['taxi_numero']; ?></td> 
                                <td><?php echo $fila['taxista_nombre']; ?></td> 
                                <td><?php echo $fila['fecha']; ?></td> 
                                <td><?php echo $fila['total_tarifas']; ?></td> 
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