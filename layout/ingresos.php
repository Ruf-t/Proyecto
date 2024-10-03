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
        ?>
        <div class="btn-select-filtro">
            <p>Filtro</p>
            <div class="selects">
            <select>
                <option value="" selected disabled>Fecha</option>
                <option>Turno 1</option>
                <option>Turno 2</option>
            </select>
            <select>
                <option value="" selected disabled>Turno</option>
                <option>Turno 1</option>
                <option>Turno 2</option>
            </select>
            <button class="btn-aplicar-filtro">Aplicar filtro</button>
            </div>
        </div>
        <div class="div-tabla-ingresos">
            <table id="tabla-ingresos">
                <thead>
                    <tr>
                        <th>N° Taxi</th>
                        <th>Taxista</th>
                        <th>Turnos</th>
                        <th>Fecha</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Pepe</td>
                    <td>Hoy</td>
                    <td>9/05/2024</td>
                    <td class="income">$420</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Pepe</td>
                    <td>Hoy</td>
                    <td>9/05/2024</td>
                    <td class="income">$420</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Pepe</td>
                    <td>Hoy</td>
                    <td>9/05/2024</td>
                    <td class="income">$420</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Pepe</td>
                    <td>Hoy</td>
                    <td>9/05/2024</td>
                    <td class="income">$420</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Pepe</td>
                    <td>Hoy</td>
                    <td>9/05/2024</td>
                    <td class="income">$420</td>
                </tr>
                </tbody>
            </table>
            <!-- <div class="div-total-turnos">
                <h3 class="total-turnos">Total de turnos: $5</h3>
                <div class="div-paginas">
                    <button class="pasar-paginas" onclick="activarBoton('1')"><img src="../resources/img/Iconos-SVG/icons-others/flecha-menorque.svg"></button>
                    <button class="paginas active" onclick="cambioColorBoton(this)">1</button>
                    <button class="paginas">2</button>
                    <button class="pasar-paginas" onclick="activarBoton('2')"><img src="../resources/img/Iconos-SVG/icons-others/flecha-mayorque.svg"></button>
                </div>
            </div> -->
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
</body>
</html>