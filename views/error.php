<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/error.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <!-- Formulario de inicio de sesión -->
        <section class="error">
            <div class="error-contenedor">
                <h2><?php echo $_GET['mensaje'] ?></h2>
                <a class="regresar" href="?url=index">Regresar</a>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>