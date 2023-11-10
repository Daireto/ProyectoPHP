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
                <h2>Editar usuario</h2>
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="campo-error"><?php echo $_GET['mensaje'] ?></div>
                <?php endif ?>
                <?php if (isset($this->errors) && count($this->errors) > 0): ?>
                    <?php foreach ($this->errors as $error): ?>
                        <div class="campo-error"><?php echo $error ?></div>
                    <?php endforeach ?>
                <?php endif ?>
                <form action="?url=usuarios&accion=editar&id=<?php echo $this->usuario['cedula'] ?>" method="post">
                    <div class="campo-formulario">
                        <label>Usuario</label>
                        <input type="text" id="usuario" name="usuario" value="<?php mostrar_campo('usuario') ?? $this->usuario['usuario'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Correo electrónico</label>
                        <input type="email" id="email" name="email" value="<?php mostrar_campo('email') ?? $this->usuario['email'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?php mostrar_campo('nombre') ?? $this->usuario['nombre'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Apellido</label>
                        <input type="text" id="apellido" name="apellido" value="<?php mostrar_campo('apellido') ?? $this->usuario['apellido'] ?>" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Cédula</label>
                        <input type="number" id="cedula" name="cedula" value="<?php mostrar_campo('cedula') ?? $this->usuario['cedula'] ?>" min="10000000" max="9999999999" required>
                    </div>
                    <div class="campo-formulario">
                        <label>Rol</label>
                        <select class="campo" id="rol" name="rol" required>
                            <?php foreach ($this->roles as $rol): ?>
                                <option value="<?php echo $rol ?>" <?php echo (mostrar_campo('rol') ?? $this->usuario['rol']) == $rol ? 'selected' : '' ?>><?php echo $rol ?></option>
                            <?php endforeach ?>
                        </select>
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