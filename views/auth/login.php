<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "../layout/head.php" ?>

    <!-- Estilos -->
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "../layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <!-- Formulario de inicio de sesión -->
        <section class="login">
            <div class="login-contenedor">
                <h2>Inicio de sesión</h2>
                <form action="#" method="post">
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

    <!-- Pié de página -->
    <?php include "../layout/footer.php" ?>
</body>
</html>
