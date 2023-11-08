<?php include "views/layout/header.php" ?>
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
                    <h2>Datos del Pago</h2>
                    <div class="ver-opciones">
                        <button class="regresar"><a href="?url=pago">Regresar</a></button>
                        <button class="editar"><a href="?url=pago&accion=editar&id=<?php echo $this->pago['codigo'] ?>">Editar</a></button>
                        <button class="eliminar"><a href="?url=pago&accion=eliminar&id=<?php echo $this->pago['codigo'] ?>">Eliminar</a></button>
                    </div>
                </div>
                <div class="ver-contenido">
                    <div class="ver-campo">
                        <div class="campo-etiqueta">codigo</div>
                        <div class="campo-valor"><?php echo $this->pago['codigo'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">monto</div>
                        <div class="campo-valor"><?php echo $this->pago['monto'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">medio</div>
                        <div class="campo-valor"><?php echo $this->pago['medio'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">codigo_est</div>
                        <div class="campo-valor"><?php echo $this->pago['codigo_est'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">fecha_creacion</div>
                        <div class="campo-valor"><?php echo $this->pago['fecha_creacion'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">fecha_actualizacion</div>
                        <div class="campo-valor"><?php echo $this->pago['fecha_actualizacion'] ?></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>