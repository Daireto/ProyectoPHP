<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/lista.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <!-- Lista de usuarios -->
        <section class="lista">
            <div class="lista-contenedor">
                <div class="lista-encabezado">
                    <h2>Usuarios</h2>
                    <div class="lista-opciones">
                        <a href="#">Crear usuario</a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="nombre-columna">Usuario</th>
                            <th class="nombre-columna">Correo electrónico</th>
                            <th class="nombre-columna">Nombre</th>
                            <th class="nombre-columna">Apellido</th>
                            <th class="nombre-columna">Cédula</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->listar() as $usuario): ?>
                            <tr class="registro">
                                <td class="campo"><?php echo $usuario['usuario'] ?></td>
                                <td class="campo"><?php echo $usuario['email'] ?></td>
                                <td class="campo"><?php echo $usuario['nombre'] ?></td>
                                <td class="campo"><?php echo $usuario['apellido'] ?></td>
                                <td class="campo"><?php echo $usuario['cedula'] ?></td>
                                <td class="opciones">
                                    <a class="ver" href="#">Ver</a>
                                    <a class="editar" href="#">Editar</a>
                                    <a class="eliminar" href="#">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>