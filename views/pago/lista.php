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
                    <h2>Pago</h2>
                    <div class="lista-opciones">
                        <a href="?url=pago&accion=crear">Crear Pago</a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="nombre-columna">Codigo</th>
                            <th class="nombre-columna">Monto</th>
                            <th class="nombre-columna">Medio</th>
                            <th class="nombre-columna">Codigo Estadia</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($this->pago) == 0): ?>
                            <tr class="crear">
                                <td class="campo" colspan="5">No se encontró ningún Pago</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach($this->pago as $pago): ?>
                            <tr class="crear">
                                <td class="campo"><?php echo $pago['codigo'] ?></td>
                                <td class="campo"><?php echo $pago['monto'] ?></td>
                                <td class="campo"><?php echo $pago['medio'] ?></td>
                                <td class="campo"><?php echo $pago['codigo_est'] ?></td>
                                <td class="opciones">
                                    <a class="ver" href="?url=pago&accion=ver&id=<?php echo $pago['codigo'] ?>">Ver</a>
                                    <a class="editar" href="?url=pago&accion=editar&id=<?php echo $pago['codigo'] ?>">Editar</a>
                                    <a class="eliminar" href="?url=pago&accion=eliminar&id=<?php echo $pago['codigo'] ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if ($this->cantidadPago > $this->cantidadPorPagina): ?>
                    <div class="paginacion">
                        <div class="cantidad-registros">
                            <?php
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $inicio = ($page - 1) * $this->cantidadPorPagina;
                                $final = $inicio + count($this->pago);
                                $rango = "Mostrando ".($inicio+1)."-".$final." pagos";
                            ?>
                            <span><?php echo $rango ?></span>
                        </div>
                        <div class="opciones">
                            <?php if ($page > 1): ?>
                                <a href="?url=pago&page=<?php echo $page - 1 ?>">Anterior</a>
                            <?php endif ?>
                            <?php if ($page < $_GET['pages']): ?>
                                <a href="?url=pago&page=<?php echo $page + 1 ?>">Siguiente</a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>