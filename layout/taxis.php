<link rel="stylesheet" href="../resources/style.css">

<body id="body-home">
    <main>
        <?php
        include '../header.php';
        ?>
        <div class="div-addTaxi">
            <h1>Lista de Taxis</h1>
            <button class="boton-add-Taxi">Añadir Taxi</button>
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
                <tr>
                    <td>3000</td>
                    <td>225.000</td>
                    <td>2017</td>
                    <td>Nissan Sentra</td>
                    <td>Activo</td>
                    <td>6/02/2023</td>
                    <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                </tr>
                <tr>
                <td>3000</td>
                    <td>225.000</td>
                    <td>2017</td>
                    <td>Nissan Sentra</td>
                    <td>Activo</td>
                    <td>6/02/2023</td>
                    <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                </tr>
                <tr>
                <td>3000</td>
                    <td>225.000</td>
                    <td>2017</td>
                    <td>Nissan Sentra</td>
                    <td>Activo</td>
                    <td>6/02/2023</td>
                    <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                </tr>
                <tr>
                <td>3000</td>
                    <td>225.000</td>
                    <td>2017</td>
                    <td>Nissan Sentra</td>
                    <td>Activo</td>
                    <td>6/02/2023</td>
                    <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                </tr>
                <tr>
                <td>3000</td>
                    <td>225.000</td>
                    <td>2017</td>
                    <td>Nissan Sentra</td>
                    <td>Activo</td>
                    <td>6/02/2023</td>
                    <td><button class="boton-editar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button><button class="boton-papelera"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button></td>
                </tr>
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
    
    <script src="../resources/script.js"></script>
</body>
</html>