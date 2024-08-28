<link rel="stylesheet" href="../resources/style.css">

<body id="body-home">
    <main>
        <?php
        include '../header.php';
        ?>
        <div class="div-addCliente">
            <h1>Clientes</h1>
            <button class="boton-add-cliente">Añadir Cliente</button>
        </div>
        <div class="tabla-clientes">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Deuda</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img src="avatar1.png" alt="Sierra Ferguson" class="avatar"><span class="name"><br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2023</td>
                    <td>04.12.2021 20:30</td>
                    <td class="income">$420</td>
                    <td><img src="resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"><img src="resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></td>
                </tr>
                <tr>
                    <td><img src="avatar2.png" alt="Sierra Ferguson" class="avatar"><span class="name"><br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2211</td>
                    <td>04.12.2021 20:24</td>
                    <td class="income">$240</td>
                    <td><img src="resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"><img src="resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></td>
                </tr>
                <tr>
                    <td><img src="avatar3.png" alt="Sierra Ferguson" class="avatar"><span class="name"><br><small>+998 (93) 486-46-15</small></span></td>
                    <td>4647</td>
                    <td>04.12.2021 20:23</td>
                    <td class="income">$1020</td>
                    <td><img src="resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"><img src="resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></td>
                </tr>
                <tr>
                    <td><img src="avatar4.png" alt="Sierra Ferguson" class="avatar"><span class="name"><br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2637</td>
                    <td>17.11.2021 12:19</td>
                    <td class="income">$300</td>
                    <td><img src="resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"><img src="resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></td>
                </tr>
                <tr>
                    <td><img src="avatar5.png" alt="Sierra Ferguson" class="avatar"><span class="name"> <br><small>+998 (93) 486-46-15</small></span></td>
                    <td>3002</td>
                    <td>04.12.2021 20:30</td>
                    <td class="income">$270</td>
                    <td><img src="resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"><img src="resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></td>
                </tr>
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
                <a href="taxistas.php" class="a-menu"><img
                        src="../resources/img/Iconos-SVG/white/driver.svg">Taximetristas</a>
                <a href="ingresos.php" class="a-menu"><img
                        src="../resources/img/Iconos-SVG/white/ingresos.svg">Ingresos</a>
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
    
    <script src="../resources/script.js"></script>
</body>
</html>