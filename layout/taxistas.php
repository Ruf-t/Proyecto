<link rel="stylesheet" href="../resources/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../resources/ajax.js"></script>

<body id="body-home">
    <main>
    <div class="respuestaAJAX">
        <p class="mensajeResult"></p>
    </div>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_taxista = mostrar_datos_taxistas($con);
        ?>

        <div class="div-addCliente">
            <h1>Lista de Taximetristas</h1>
            <!-- <button class="btn-abrir-modal boton-add-cliente">Añadir Taximetrista</button> -->
            <button id="btn-abrir-modal" class="btn-abrir-modal boton-add-cliente">Añadir Taximetrista</button>
        </div>

        <dialog class="modal">
    <div class="div-titulo-modal">
        <h2>Agregar Nuevo Taximetrista</h2> 
    </div>
    <form id="form-add-taxistas" method="post">
        <div class="div-labels-forms">
            <label>Nombre:
                <input type="text" name="Nombre" id="Nombre-Nuevo-Taxista">
            </label>

            <label>Apellido:
                <input type="text" name="Apellido-Nuevo-Taxista">
            </label> 
        </div>  
        <div class="div-labels-forms">
            <label>Fecha de Nacimiento:
                <input type="date" name="FechaNac-Nuevo-Taxista">
            </label>

            <label>Fecha venc. de libreta de conducir:
                <input type="date" name="Fecha-venc-librCond-Nuevo-Taxista">
            </label>
        </div>              
        <div class="div-labels-forms">
            <label class="label-direccion">Dirección:
                <input type="text" name="Direccion-Nuevo-Taxista" id="Direccion-Nuevo-Taxista">
            </label>
            <label class="label-direccion">Telefono:
                <input type="text" name="Telefono-Nuevo-Taxista" id="Telefono-Nuevo-Taxista">
            </label>
        </div>
        <div class="div-labels-forms">
            <label class="label-direccion">Usuario:
                <input type="text" name="UserNuevo-Taxista" id="UserNuevo-Taxista">
            </label>
            <label class="label-direccion">Contraseña:
                <input type="password" name="ContrNuevo-Taxista" id="ContrNuevo-Taxista">
            </label>
        </div>
        <div class="div-labels-forms">
            <button type="submit" class="boton-enviar-modal">Enviar</button>
        </div>
    </form>
</dialog>

        <div class="tabla-clientes">
            <table>
                <thead>
                    <tr class="columnas-tabla-clientes">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nacimiento</th>
                        <th>Direccion</th>
                        <th>Fecha de vencimiento libreta</th> 
                        <th>Teléfono</th>
                        <th>Info Taxista</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($datos_taxista as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['Nombre'];?></td>    
                            <td><?php echo $fila['Apellido'];?></td>    
                            <td><?php echo $fila['Fecha_Nacimiento'];?></td>  
                            <td><?php echo $fila['Direccion'];?></td>  
                            <td><?php echo $fila['Fecha_Expiracion_Licencia']; ?></td>
                            <td><?php echo $fila['Telefono']; ?></td> 
                            <td><img src="../resources/img/Iconos-SVG/icons-others/edit.svg"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

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