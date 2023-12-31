<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/principal.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Cabecera -->
    <header>
        <h2>Bienvenido a</h2>
        <h1>Parking Manager</h1>
    </header>

    <!-- Contenido principal -->
    <main>
        <!-- Horarios -->
        <section class="horarios">
            <h2>Horarios de disponibilidad</h2>
            <table class="tabla-horarios">
                <thead>
                    <tr>
                        <th>Lunes - Viernes</th>
                        <th>Sábados</th>
                        <th>Domingos y festivos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>7:00am - 8:00pm</td>
                        <td>7:00am - 10:00pm</td>
                        <td>9:00am - 6:00pm</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Formulario de contacto -->
        <section class="contacto">
            <div class="contacto-contenedor">
                <div class="contacto-imagen">
                    <img src="assets/img/imagen-contacto.jpg" alt="Imagen del formulario de contacto">
                </div>
                <div class="contenedor-formulario-contacto">
                    <h2>Contáctenos</h2>
                    <?php if (isset($_GET['texto'])): ?>
                        <p class="mensaje-formulario"><?php echo $_GET['texto'] ?></p>
                        <script>window.scrollTo(0, document.body.scrollHeight);</script>
                    <?php endif ?>
                    <form class="formulario-contacto" action="?url=mensajes&accion=crear" method="post">
                        <div class="campo-formulario">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="email">Correo:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="asunto">Asunto:</label>
                            <input type="text" id="asunto" name="asunto" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="mensaje">Mensaje:</label>
                            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="enviar">Enviar</button>
                    </form>
                    <div class="whatsapp-logo">
                        <a href="https://chat.whatsapp.com/BmvUrR8aS3eC50xaFkg9Ry" target="_blank">
                            <img src="assets/img/whatsapp.png" alt="Logo de WhatsApp">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>