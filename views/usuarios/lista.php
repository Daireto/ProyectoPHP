<?php include "views/layout/header.php" ?>
    <link rel="stylesheet" href="assets/css/layout/lista.css">
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "views/layout/nav.php" ?>

    <!-- Contenido principal -->
    <main>
        <section class="lista">
            <div class="lista-contenedor">
                <div class="lista-encabezado">
                    <h2>Usuarios</h2>
                    <div class="lista-opciones">
                        <a href="?url=usuarios&accion=crear">Crear usuario</a>
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
                            <th class="nombre-columna">Rol</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($this->usuarios) == 0): ?>
                            <tr class="registro">
                                <td class="campo" colspan="6">No se encontró ningún usuario</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach($this->usuarios as $usuario): ?>
                            <tr class="registro">
                                <td class="campo"><?php echo $usuario['usuario'] ?></td>
                                <td class="campo"><?php echo $usuario['email'] ?></td>
                                <td class="campo"><?php echo $usuario['nombre'] ?></td>
                                <td class="campo"><?php echo $usuario['apellido'] ?></td>
                                <td class="campo"><?php echo $usuario['cedula'] ?></td>
                                <td class="campo"><?php echo $usuario['rol'] ?></td>
                                <td class="opciones">
                                    <a class="ver" href="?url=usuarios&accion=ver&id=<?php echo $usuario['cedula'] ?>">Ver</a>
                                    <a class="editar" href="?url=usuarios&accion=editar&id=<?php echo $usuario['cedula'] ?>">Editar</a>
                                    <a class="eliminar" href="?url=usuarios&accion=eliminar&id=<?php echo $usuario['cedula'] ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if ($this->cantidadUsuarios > $this->cantidadPorPagina): ?>
                    <div class="paginacion">
                        <div class="cantidad-registros">
                            <?php
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $inicio = ($page - 1) * $this->cantidadPorPagina;
                                $final = $inicio + count($this->usuarios);
                                $rango = "Mostrando ".($inicio+1)."-".$final." usuarios";
                            ?>
                            <span><?php echo $rango ?></span>
                        </div>
                        <div class="opciones">
                            <?php if ($page > 1): ?>
                                <a href="?url=usuarios&page=<?php echo $page - 1 ?>">Anterior</a>
                            <?php endif ?>
                            <?php if ($page < $_GET['pages']): ?>
                                <a href="?url=usuarios&page=<?php echo $page + 1 ?>">Siguiente</a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>