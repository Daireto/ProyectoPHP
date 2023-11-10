<nav>
    <div class="left-menu">
        <a class="logo" href="?url=principal">
            <img src="assets/img/logo.png" alt="Logo">
        </a>
        <?php if (isset($_SESSION['usuario']) && validar_rol('Admin')): ?>
            <ul class="menu">
                <li class="item"><a href="?url=usuarios">Usuarios</a></li>
                <li class="item"><a href="?url=estadias">Estadías</a></li>
                <li class="item"><a href="?url=pago">Pagos</a></li>
                <li class="item"><a href="?url=mensajes">Mensajes <span class="mensajes-pendientes"><?php echo $_GET['mensajesPendientes'] ?></span></a></li>
            </ul>
        <?php endif ?>
    </div>
    <ul class="menu">
        <?php if (!isset($_SESSION['usuario'])): ?>
            <li class="item"><a href="?url=principal">Inicio</a></li>
            <li class="item"><a href="?url=login">Iniciar sesión</a></li>
            <li class="item"><a href="?url=register">Registrarse</a></li>
        <?php else: ?>
            <li class="item"><a href="?url=cuenta"><?php echo $_SESSION['usuario'] ?></a></li>
            <li class="item"><a href="?url=logout">Cerrar sesión</a></li>
        <?php endif ?>
    </ul>
</nav>