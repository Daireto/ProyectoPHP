<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/crear-editar.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="crear-editar">
            <div class="formulario-contenedor">
                <h2>Editar estadía</h2>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="campo-error"><?php echo $_GET['mensaje'] ?></div>
                <?php endif ?>
                <?php if (isset($this->errors) && count($this->errors) > 0): ?>
                    <?php foreach ($this->errors as $error): ?>
                        <div class="campo-error"><?php echo $error ?></div>
                    <?php endforeach ?>
                <?php endif ?>
                <form action="?url=estadias&accion=editar&id=<?php echo $this->estadia['codigo'] ?>" method="post">
                    <div class="campo-formulario">
                        <label>Placa</label>
                        <input type="text" id="placa" name="placa" value="<?php echo mostrar_campo('placa') ?? $this->estadia['placa'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Cédula</label>
                        <input type="number" id="cedula" name="cedula" value="<?php echo mostrar_campo('cedula') ?? $this->estadia['cedula'] ?>" min="10000000" max="9999999999" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Fecha de ingreso</label>
                        <input type="datetime-local" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo mostrar_campo('fecha_ingreso') ?? $this->estadia['fecha_ingreso'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Fecha de salida</label>
                        <input type="datetime-local" id="fecha_salida" name="fecha_salida" value="<?php echo mostrar_campo('fecha_salida') ?? $this->estadia['fecha_salida'] ?>" required>
                    </div>
                    <div class="opciones-formulario">
                        <button class="submit" type="submit">Guardar</button>
                        <button class="cancelar" onclick="window.history.go(-1); return false;">Cancelar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>