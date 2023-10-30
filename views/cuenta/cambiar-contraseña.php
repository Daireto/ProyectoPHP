<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/crear-editar.css">
    <link rel="stylesheet" href="assets/css/cuenta/cambiar-contraseña.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="cambiar-contraseña">
            <div class="formulario-contenedor">
                <h2>Cambiar contraseña</h2>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="campo-error"><?php echo $_GET['mensaje'] ?></div>
                <?php endif ?>
                <?php if (isset($this->errors) && count($this->errors) > 0): ?>
                    <?php foreach ($this->errors as $error): ?>
                        <div class="campo-error"><?php echo $error ?></div>
                    <?php endforeach ?>
                <?php endif ?>
                <form action="?url=cuenta&accion=cambiar-contraseña" method="post">
                    <div class="campo-formulario">
                        <label>Contraseña actual</label>
                        <input type="password" id="password-actual" name="password-actual" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Contraseña nueva</label>
                        <input type="password" id="password-nueva" name="password-nueva" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Confirmar contraseña</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <div class="opciones-formulario">
                        <button class="submit" type="submit">Guardar</button>
                        <button class="cancelar" onclick="window.history.go(-1); return false;">Cancelar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>