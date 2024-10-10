<link rel="stylesheet" href="../style/style-Taximetristas.css">
<header>
   <!-- <button>
       <img src="../../resources/img/Iconos-SVG/icons-others/menu-icon-taximetrista.svg" alt="">
   </button>  -->
<h3 id="h3_header">Hola, <?php echo $userTaxi; ?>!</h3>

<form method="post" action="../../BaseDatos/login-bd.php">
    <button type="submit" name="cerrarSesionTaximetrista" class="btn-logout-taxi"><img src="../../resources/img/Iconos-SVG/icons-others/exit-icon.svg" alt=""></button>
</form>
</header>