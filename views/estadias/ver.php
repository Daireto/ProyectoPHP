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
                    <h2>Datos de la estadía</h2>
                    <div class="ver-opciones">
                        <button class="regresar"><a href="?url=estadias">Regresar</a></button>
                        <button class="editar"><a href="?url=estadias&accion=editar&id=<?php echo $this->estadia['codigo'] ?>">Editar</a></button>
                        <button class="eliminar"><a href="?url=estadias&accion=eliminar&id=<?php echo $this->estadia['codigo'] ?>">Eliminar</a></button>
                    </div>
                </div>
                <div class="ver-contenido">
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Código</div>
                        <div class="campo-valor"><?php echo $this->estadia['codigo'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Placa</div>
                        <div class="campo-valor"><?php echo $this->estadia['placa'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de ingreso</div>
                        <div class="campo-valor"><?php echo $this->estadia['fecha_ingreso'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de salida</div>
                        <div class="campo-valor"><?php echo $this->estadia['fecha_salida'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Cédula</div>
                        <div class="campo-valor"><?php echo $this->estadia['cedula'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Pagada</div>
                        <div class="campo-valor">
                            <?php if ($this->estadia['codigo_est'] != null): ?>
                                <a href="?url=pagos&accion=ver&id=<?php echo $this->estadia['codigo_est'] ?>">Si</a>
                            <?php else: ?>
                                No
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de creación</div>
                        <div class="campo-valor"><?php echo $this->estadia['fecha_creacion'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de actualización</div>
                        <div class="campo-valor"><?php echo $this->estadia['fecha_actualizacion'] ?></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>