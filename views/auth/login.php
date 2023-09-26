<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/auth/login.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <!-- Formulario de inicio de sesión -->
        <section class="login">
            <div class="login-contenedor">
                <h2>Inicio de sesión</h2>
                <?php if (isset($this->errors) && count($this->errors) > 0): ?>
                    <?php foreach ($this->errors as $error): ?>
                        <div class="campo-error"><?php echo $error ?></div>
                    <?php endforeach ?>
                <?php endif ?>
                <form action="?url=login" method="post">
                    <div class="campo-formulario">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="enviar">Ingresar</button>
                </form>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>