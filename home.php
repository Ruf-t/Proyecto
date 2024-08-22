<link rel="stylesheet" href="resources/style.css">

<body id="body-home">
    <main>
        <?php
        include 'header.php';
        ?>
            <div class="div-panel-administracion">
                <h3>Panel de administracion</h3>
                <div class="div-botones-administracion">
                    <button><img src="resources/img/Iconos-SVG/icons-others/folder-open-blue.svg">Ordenes Totales<img src="resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                    <button><img src="resources/img/Iconos-SVG/icons-others/folder-open-red.svg">Ganancias Totales<img src="resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>                
                    <button><img src="resources/img/Iconos-SVG/icons-others/folder-open-orange.svg">Taxis<img src="resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                </div>
            </div>
            <div class="div-taxistas-mes">
                <p>Taximetristas del mes</p>
                <div>
                    <p>Maharrm Hasanli</p>
                    <p>+598 92112906</p>
                </div>
                <div>
                    <p>Gina Garza</p>
                    <p>+598 92112906</p>
                </div>
                <div>
                    <p>Brian Reed</p>
                    <p>+598 92112906</p>
                </div>
                <div>
                    <p>Tammy Spencer</p>
                    <p>+598 92112906</p>
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
                    <img src="resources/img/Iconos-SVG/white/home.svg">Panel
                </a>
                <a href="viajes.php" class="a-menu"><img src="resources/img/Iconos-SVG/white/bookmark.svg">Viajes</a>
                <a href="clientes.php" class="a-menu"><img src="resources/img/Iconos-SVG/white/cliente.svg">Clientes</a>
                <a href="taxistas.php" class="a-menu"><img
                        src="resources/img/Iconos-SVG/white/driver.svg">Taximetristas</a>
                <a href="ingresos.php" class="a-menu"><img
                        src="resources/img/Iconos-SVG/white/ingresos.svg">Ingresos</a>
                <a href="taxis.php" class="a-menu"><img src="resources/img/Iconos-SVG/white/taxi.svg">Taxis</a>
            </nav>
        </div>
        <div class="config-container">
            <nav>
                <a href="configuracion.php" class="a-menu">
                    <img src="resources/img/Iconos-SVG/white/setting.svg">Configuracion</a>
            </nav>
        </div>
    </div>



    <script src="resources/script.js"></script>
</body>

</html>