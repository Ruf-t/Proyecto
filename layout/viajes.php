<link rel="stylesheet" href="../resources/style.css">

<body id="body-home">
    <main>
        <?php
        include '../header.php';
        ?>
        <div class="div-tabla-viajes">
            <table>
                <thead>
                    <select>
                        <option value="" selected disabled>Selecciona un turno</option>
                        <option>Turno 1</option>
                        <option>Turno 2</option>
                    </select>
                    <tr>
                        <th><button>Hoy</button></th>
                        <th><button>Hace un dia</button></th>
                        <th><button>En la semana</button></th>
                        <th><button>En el mes</button></th>
                        <th><button>Ultimos 6 meses</button></th>
                        <th><button>Fecha personalizada</button></th>
                    </tr>
                    <tr>
                        <th>Cliente</th>
                        <th>Número de coche</th>
                        <th>Fecha Viaje</th>
                        <th>Km Inicial</th>
                        <th>Km Final</th>
                        <th>Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img src="avatar1.png" alt="Sierra Ferguson" class="avatar"><span class="name">Sierra Ferguson<br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2023</td>
                    <td>04.12.2021 20:30</td>
                    <td>Km 120.000</td>
                    <td>Km 120.050</td>
                    <td class="income">$420</td>
                </tr>
                <tr>
                    <td><img src="avatar2.png" alt="Sierra Ferguson" class="avatar"><span class="name">Sierra Ferguson<br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2211</td>
                    <td>04.12.2021 20:24</td>
                    <td>Km 32.000</td>
                    <td>Km 32.023</td>
                    <td class="income">$240</td>
                </tr>
                <tr>
                    <td><img src="avatar3.png" alt="Sierra Ferguson" class="avatar"><span class="name">Sierra Ferguson<br><small>+998 (93) 486-46-15</small></span></td>
                    <td>4647</td>
                    <td>04.12.2021 20:23</td>
                    <td>Km 450.000</td>
                    <td>Km 450.120</td>
                    <td class="income">$1020</td>
                </tr>
                <tr>
                    <td><img src="avatar4.png" alt="Sierra Ferguson" class="avatar"><span class="name">Sierra Ferguson<br><small>+998 (93) 486-46-15</small></span></td>
                    <td>2637</td>
                    <td>17.11.2021 12:19</td>
                    <td>Km 362.757</td>
                    <td>Km 362.780</td>
                    <td class="income">$300</td>
                </tr>
                <tr>
                    <td><img src="avatar5.png" alt="Sierra Ferguson" class="avatar"><span class="name">Sierra Ferguson<br><small>+998 (93) 486-46-15</small></span></td>
                    <td>3002</td>
                    <td>04.12.2021 20:30</td>
                    <td>Km 23.899</td>
                    <td>Km 23.920</td>
                    <td class="income">$270</td>
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