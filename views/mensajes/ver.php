<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/ver.css">
    <link rel="stylesheet" href="assets/css/mensajes/ver.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="ver">
            <div class="ver-contenedor">
                <div class="ver-encabezado">
                    <h2>Datos del mensaje</h2>
                    <div class="ver-opciones">
                        <button class="regresar"><a href="?url=mensajes">Regresar</a></button>
                        <button class="eliminar"><a href="?url=mensajes&accion=eliminar&id=<?php echo $this->mensaje['codigo'] ?>">Eliminar</a></button>
                    </div>
                </div>
                <div class="ver-contenido">
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Código</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['codigo'] ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <?php if ($this->mensaje['cedula'] != null): ?>
                            <div class="campo-etiqueta">Leído por</div>
                            <div class="campo-valor">
                                <?php echo $this->mensaje['cedula'] ?>
                            </div>
                        <?php else: ?>
                            <div class="campo-etiqueta">Leído</div>
                            <div class="campo-valor">No</div>
                        <?php endif; ?>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Nombre</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['nombre'] ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Correo electrónico</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['email'] ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Asunto</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['asunto'] ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Mensaje</div>
                        <textarea class="campo-textarea" rows="5" readonly><?php echo $this->mensaje['mensaje'] ?></textarea>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de creación</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['fecha_creacion'] ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de actualización</div>
                        <div class="campo-valor">
                            <?php echo $this->mensaje['fecha_actualizacion'] ?>
                        </div>
                    </div>
                    <div class="ver-campo expandir">
                        <?php if ($this->mensaje['cedula'] === null): ?>
                            <form action="?url=mensajes&accion=marcarLeido&id=<?php echo $this->mensaje['codigo'] ?>"
                                method="post">
                                <button class="marcar-leido" type="submit">Marcar como leído</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>