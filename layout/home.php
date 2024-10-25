<?php

session_start();
?>

<link rel="stylesheet" href="../resources/style.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="../resources/ajax.js"></script>
<body id="body-home">   
    <main>
        <?php
        include '../header.php';
        include '../BaseDatos/functions.php';
        $datos_viaje = datos_tabla_viaje($con);
        ?>
        
        <section class="div-taxistas-mes">
            <h3 id="h3_taxistas_mes"></h3>
            <div class="ranking-taxistas">
            </div>
        </section>

        
        <div class="div-h3-panel">
            <h3 id="h3_tabla_viaje_panel"></h3>
        </div>
        <div class="div-tabla-panel">
            <table id="table-panel">
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