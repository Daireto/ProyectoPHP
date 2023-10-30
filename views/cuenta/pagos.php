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
                    <h2>Mis pagos</h2>
                    <div class="lista-opciones">
                        <a href="?url=cuenta">Regresar</a>
                        <a href="?url=cuenta&accion=estadias">Mis estadías</a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="nombre-columna">Código</th>
                            <th class="nombre-columna">Monto pagado</th>
                            <th class="nombre-columna">Medio de pago</th>
                            <th class="nombre-columna">Código de la estadía</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($this->pagos) == 0): ?>
                            <tr class="registro">
                                <td class="campo" colspan="5">No se encontró ningún pago</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach($this->pagos as $pago): ?>
                            <tr class="registro">
                                <td class="campo"><?php echo $pago['codigo'] ?></td>
                                <td class="campo"><?php echo $pago['monto'] ?></td>
                                <td class="campo"><?php echo $pago['medio'] ?></td>
                                <td class="campo"><?php echo $pago['codigo_est'] ?></td>
                                <td class="opciones">
                                    <a class="ver" href="?url=cuenta&accion=ver-pago">Ver</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if ($this->cantidadPagos > $this->cantidadPorPagina): ?>
                    <div class="paginacion">
                        <div class="cantidad-registros">
                            <?php
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $inicio = ($page - 1) * $this->cantidadPorPagina;
                                $final = $inicio + count($this->pagos);
                                $rango = "Mostrando ".($inicio+1)."-".$final." pagos";
                            ?>
                            <span><?php echo $rango ?></span>
                        </div>
                        <div class="opciones">
                            <?php if ($page > 1): ?>
                                <a href="?url=cuenta&page=<?php echo $page - 1 ?>">Anterior</a>
                            <?php endif ?>
                            <?php if ($page < $_GET['pages']): ?>
                                <a href="?url=cuenta&page=<?php echo $page + 1 ?>">Siguiente</a>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </main>
<?php include "views/layout/footer.php" ?>