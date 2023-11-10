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
                    <h2>Mensajes</h2>
                    <div class="lista-opciones"></div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="nombre-columna">Código</th>
                            <th class="nombre-columna">Correo electrónico</th>
                            <th class="nombre-columna">Asunto</th>
                            <th class="nombre-columna">Leido</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($this->mensajes) == 0): ?>
                            <tr class="registro">
                                <td class="campo" colspan="6">No se encontró ningún mensaje</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($this->mensajes as $mensaje): ?>
                            <tr class="registro">
                            <td class="campo">
                                    <?php echo $mensaje['codigo'] ?>
                                </td>
                                <td class="campo">
                                    <?php echo $mensaje['email'] ?>
                                </td>
                                <td class="campo">
                                    <?php echo $mensaje['asunto'] ?>
                                </td>
                                <td class="campo">
                                <?php if ($mensaje['cedula'] != null): ?>
                                    Si
                                <?php else: ?>
                                    No
                                <?php endif; ?>
                                </td>
                                <td class="opciones">
                                    <a class="ver"
                                        href="?url=mensajes&accion=ver&id=<?php echo $mensaje['codigo'] ?>">Ver</a>
                                    <a class="eliminar"
                                        href="?url=mensajes&accion=eliminar&id=<?php echo $mensaje['codigo'] ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if ($this->cantidadMensajes > $this->cantidadPorPagina): ?>
                    <div class="paginacion">
                        <div class="cantidad-registros">
                            <?php
                            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                            $inicio = ($page - 1) * $this->cantidadPorPagina;
                            $final = $inicio + count($this->mensajes);
                            $rango = "Mostrando " . ($inicio + 1) . "-" . $final . " mensajes";
                            ?>
                            <span>
                                <?php echo $rango ?>
                            </span>
                        </div>
                        <div class="opciones">
                            <?php if ($page > 1): ?>
                                <a href="?url=mensajes&page=<?php echo $page - 1 ?>">Anterior</a>
                            <?php endif ?>
                            <?php if ($page < $_GET['pages']): ?>
                                <a href="?url=mensajes&page=<?php echo $page + 1 ?>">Siguiente</a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>