<nav>
    <div class="left-menu">
        <a class="logo" href="?url=index">
            <img src="assets/img/logo.png" alt="Logo">
        </a>
        <?php if (isset($_SESSION['usuario'])): ?>
            <ul class="menu">
                <li class="item"><a href="?url=usuarios">Usuarios</a></li>
                <li class="item"><a href="?url=ingresos">Ingresos</a></li>
                <li class="item"><a href="?url=salidas">Salidas</a></li>
                <li class="item"><a href="?url=pagos">Pagos</a></li>
                <li class="item"><a href="?url=mensajes">Mensajes</a></li>
            </ul>
        <?php endif ?>
    </div>
    <ul class="menu">
        <?php if (!isset($_SESSION['usuario'])): ?>
            <li class="item"><a href="?url=index">Inicio</a></li>
            <li class="item"><a href="?url=login">Iniciar sesión</a></li>
            <li class="item"><a href="?url=register">Registrarse</a></li>
        <?php else: ?>
            <li class="item"><a href="?url=perfil"><?php echo $_SESSION['usuario'] ?></a></li>
            <li class="item"><a href="?url=logout">Cerrar sesión</a></li>
        <?php endif ?>
    </ul>
</nav>