<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/lista.css">
    <link rel="stylesheet" href="assets/css/layout/ver.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="ver">
            <div class="ver-contenedor">
                <div class="ver-encabezado">
                    <h2>Perfil del usuario</h2>
                    <div class="ver-opciones">
                        <button class="estadias"><a href="?url=cuenta&accion=estadias">Mis estadías</a></button>
                        <button class="pagos"><a href="?url=cuenta&accion=pagos">Mis pagos</a></button>
                        <button class="cambiar-contraseña"><a href="?url=cuenta&accion=cambiar-contraseña">Cambiar contraseña</a></button>
                    </div>
                </div>
                <div class="ver-contenido">
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Usuario</div>
                        <div class="campo-valor"><?php echo $this->usuario['usuario'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Correo electrónico</div>
                        <div class="campo-valor"><?php echo $this->usuario['email'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Nombre</div>
                        <div class="campo-valor"><?php echo $this->usuario['nombre'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Apellido</div>
                        <div class="campo-valor"><?php echo $this->usuario['apellido'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Cédula</div>
                        <div class="campo-valor"><?php echo $this->usuario['cedula'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Rol</div>
                        <div class="campo-valor"><?php echo $this->usuario['rol'] ?></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>