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
                <h2>Crear pago</h2>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="campo-error"><?php echo $_GET['mensaje'] ?></div>
                <?php endif ?>
                <?php if (isset($this->errors) && count($this->errors) > 0): ?>
                    <?php foreach ($this->errors as $error): ?>
                        <div class="campo-error"><?php echo $error ?></div>
                    <?php endforeach ?>
                <?php endif ?>
                <form action="?url=pago&accion=crear" method="post">
                    <div class="campo-formulario">
                        <label>monto</label>
                        <input type="number" id="monto" name="monto" value="<?php echo mostrar_campo('monto') ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>medio</label>
                        <input type="text" id="medio" name="medio" value="<?php echo mostrar_campo('medio') ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>codigo_est</label>
                        <input type="number" id="codigo_est" name="codigo_est" value="<?php echo mostrar_campo('codigo_est') ?>" required>
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