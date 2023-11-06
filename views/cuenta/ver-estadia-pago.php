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
                        <button class="regresar"><a href="?url=cuenta&accion=estadias">Mis estadías</a></button>
                        <button class="regresar"><a href="?url=cuenta&accion=pagos">Mis pagos</a></button>
                    </div>
                </div>
                <div class="ver-contenido">
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Código</div>
                        <div class="campo-valor"><?php echo $this->estadia['codigo_estadia'] ?></div>
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
                            <?php if ($this->pago != null && $this->pago['codigo_pago'] != null): ?>
                                Si
                            <?php else: ?>
                                No
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de creación</div>
                        <div class="campo-valor"><?php echo $this->estadia['creacion_estadia'] ?></div>
                    </div>
                    <div class="ver-campo">
                        <div class="campo-etiqueta">Fecha de actualización</div>
                        <div class="campo-valor"><?php echo $this->estadia['act_estadia'] ?></div>
                    </div>
                </div>
            </div>
            <?php if ($this->pago != null): ?>
                <div class="ver-contenedor">
                    <div class="ver-encabezado">
                        <h2>Datos del pago de la estadía</h2>
                    </div>
                    <div class="ver-contenido">
                        <div class="ver-campo">
                            <div class="campo-etiqueta">Código</div>
                            <div class="campo-valor"><?php echo $this->pago['codigo'] ?></div>
                        </div>
                        <div class="ver-campo">
                            <div class="campo-etiqueta">Monto pagado</div>
                            <div class="campo-valor"><?php echo $this->pago['monto'] ?></div>
                        </div>
                        <div class="ver-campo">
                            <div class="campo-etiqueta">Medio de pago</div>
                            <div class="campo-valor"><?php echo $this->pago['medio'] ?></div>
                        </div>
                        <div class="ver-campo"></div>
                        <div class="ver-campo">
                            <div class="campo-etiqueta">Fecha de creación</div>
                            <div class="campo-valor"><?php echo $this->pago['creacion_pago'] ?></div>
                        </div>
                        <div class="ver-campo">
                            <div class="campo-etiqueta">Fecha de actualización</div>
                            <div class="campo-valor"><?php echo $this->pago['act_pago'] ?></div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>