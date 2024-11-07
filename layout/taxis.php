<link rel="stylesheet" href="../resources/style.css">
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../resources/img/Logos-SVG-SinFondo/Modelo-B/Logo-3B.svg" type="image/png">
        <link rel="stylesheet" href="../resources/style.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="../resources/ajax.js"></script>
        <title id="title_taxis"></title>
    </head>
<body id="body-home">
    <main>
        <?php
        include '../header.php';
        require_once '..\BaseDatos\functions.php';
        $datos_taxis = mostrar_datos_taxis($con);
        ?>
        <div class="div-addTaxi">
            <h1 id="h1_taxi"></h1>
            <button class="btn-abrir-modal boton-add-Taxi" id="btn_abrir_modal_taxi"></button>
        </div>

        <div class="tabla-Taxis">
            <table>
                <thead> 
                    <tr class="columnas-tabla-Taxis">
                        <th id="th_numero_taxi"></th>
                        <th id="th_modelo"></th>
                        <th id="th_anio"></th>
                        <th id="th_estado"></th>
                        <th id="th_modificar_eliminar"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($datos_taxis as $fila) { ?>
                        <tr>
                            <tr data-id="<?php echo $fila['ID']; ?>">  <!-- Aquí agregamos el ID -->
                            <td><?php echo $fila['Matricula']; ?></td>
                            <td><?php echo $fila['Modelo']; ?></td>
                            <td><?php echo $fila['Año']; ?></td>
                            <td><?php echo $fila['Estado']; ?></td>
                            <td>
                                <button class="boton-editar btn-abrir-modal-modificar"><img src="../resources/img/Iconos-SVG/icons-others/edit.svg" class="editar"></button>
                                <button class="boton-papelera btn-abrir-modal-eliminar"><img src="../resources/img/Iconos-SVG/icons-others/trash.svg" class="papelera"></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>  
    </main>
    
    <!-- ---------------------------MODAL AÑADIR-------------------------- -->
    <dialog class="modal">
        <div class="div-titulo-modal">
            <h2 id="h2_agregar_taxi"></h2>
            <button class="btn-cerrar-modal"><img src="../resources/img/Iconos-SVG/icons-others/cruz-exit.svg"></button>
        </div>
        <form id="form-add-taxi" class="formulario" method="post">
            <div class="div-labels-forms">
                <label><span id="label_matricula"></span><input type="text" name="matricula" id="matricula"></label>
                <label><span id="label_modelo"></span><input type="text" name="modelo" id="modelo"></label>
            </div>
            <div class="div-labels-forms">
                <label><span id="label_anio"></span><input type="number" name="anio" id="anio"></label>
                <label><span id="label_estado"></span>
                    <select name="estado" id="estado" class="select-estado">
                    <option value="" id="option_select_estado"></option>
                    <option value="Disponible" id="option_select_estado1"></option>
                    <option value="No Disponible" id="optiobtnn_select_estado2"></option>
                    </select>
                </label>
            </div>
            <div class="div-labels-forms-button">
                <button type="submit" class="boton-enviar-modal-taxis btn-cerrar-modal" id="btn_add_taxi"></button>
            </div>
        </form>
        <div class="respuestaAJAX">
            <p class="mensajeResult"></p>
        </div>
    </dialog>

    <!-- ------------------------------------MODAL MODIFICAR------------------------------------------- -->
    <dialog class="modal-modificar">
        <div class="div-titulo-modal-modificar">
            <h2 id="h2_modificar_taxi"></h2>   
            <button class="btn-cerrar-modal"><img src="../resources/img/Iconos-SVG/icons-others/cruz-exit.svg"></button>
        </div>
        <form id="form-modi-taxi" class="formulario" method="post">
            <input type="hidden" name="id" id="id_Modificar" value="">
            <div class="div-labels-forms">
                <label><span id="label_matricula_modi"></span><input type="text" name="matricula" id="matricula_Modificar"></label>
                <label><span id="label_modelo_modi"></span><input type="text" name="modelo" id="modelo_Modificar"></label>
            </div>
            <div class="div-labels-forms">
                <label><span id="label_anio_modi"></span><input type="number" name="anio" id="anio_Modificar"></label>
                <label><span id="label_estado_modi"></span>
                    <select name="estado" id="estado_Modificar" class="select-estado">
                    <option value="" id="option_select_estado_modi"></option>
                    <option value="Disponible" id="option_select_estado1_modi"></option>
                    <option value="No Disponible" id="optiobtnn_select_estado2_modi"></option>
                    </select>
                </label>
            </div>
            <div class="div-labels-forms-button">
                <button type="submit" class="boton-enviar-modal-taxis btn-cerrar-modal-modificar" id="btn_add_taxi_modi"></button>
            </div>
        </form>
    </dialog>

    <!--------------------------------------MODAL ELIMINAR------------------------------------------------->
    <dialog class="modal-eliminar">
        <div class="div-titulo-modal-eliminar">
            <h2 id="h2_eliminar_taxi"></h2>   
        </div>
        <div class="btns-aceptar-cancelar">
            <button id="eliminar_aceptar"></button>
            <button id="eliminar_cancelar" class="btn-cerrar-modal-eliminar"></button>
        </div>
        <div class="respuestaAJAX-Modal">
            <p class="mensajeResultModal"></p>
        </div>
    </dialog>
    
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