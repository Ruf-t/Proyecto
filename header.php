<?php    
session_start();
if (!isset($_SESSION['Usuario'])) {
    header("Location: ../Register-Login/login.php");
    exit;
}

?>
<div class="header">
    <div class="nombre-usuario">
        <h1><span id="titulo_header"></span><?php echo $_SESSION['Usuario']; ?></h1>
    </div>
</div> 