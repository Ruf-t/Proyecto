<link rel="stylesheet" href="../resources/style.css">
<body id="body-home">
    <main>
        <?php
        include '../header.php';
        ?>
        <div class="div-configuracion">
            <h3 id="h3_opciones"></h3>
            <button id="switch_idioma"></button>
            <form method="post" action="../BaseDatos/login-bd.php">
                <button type="submit" name="cerrar_sesion" id="cerrar_sesion"></button>
            </form>
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