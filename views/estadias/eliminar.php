<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/eliminar.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="eliminar">
            <div class="eliminar-contenedor">
                <h2>Eliminar estadía</h2>
                <p class="texto-confirmar">¿Desea eliminar la estadía con código <span id="id-registro"><?php echo $this->estadia['codigo'] ?></span>?</p>
                <p class="texto-advertencia">¡Esta operación es irreversible!</p>
                <form action="?url=estadias&accion=eliminar&id=<?php echo $this->estadia['codigo'] ?>" method="post">
                    <input type="hidden" id="id" name="id" value="<?php echo $this->estadia['codigo'] ?>">
                    <div class="opciones-formulario">
                        <button class="submit" type="submit">Eliminar</button>
                        <button class="cancelar" onclick="window.history.go(-1); return false;">Cancelar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>