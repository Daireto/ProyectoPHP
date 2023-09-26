<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/auth/register.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <!-- Formulario de inicio de sesión -->
        <section class="registro">
            <div class="registro-contenedor">
                <h2>Registro</h2>
                <form action="?url=register" method="post">
                    <div class="campo-formulario">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="cedula">Cédula:</label>
                        <input type="number" id="cedula" name="cedula" min="10000000" max="9999999999" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="confirm-password">Confirmar contraseña:</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit" class="enviar">Registrarse</button>
                </form>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>