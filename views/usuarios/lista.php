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
                            <th>Usuario</th>
                            <th>Correo electrónico</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($userController->listar() as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['usuario'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo $usuario['nombre'] ?></td>
                                <td><?php echo $usuario['apellido'] ?></td>
                                <td><?php echo $usuario['cedula'] ?></td>
                                <td class="registro-opciones">
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