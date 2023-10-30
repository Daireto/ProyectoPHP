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
                    <h2>Mis estadías</h2>
                    <div class="lista-opciones">
                        <a href="?url=cuenta">Regresar</a>
                        <a href="?url=cuenta&accion=pagos">Mis pagos</a>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="nombre-columna">Código</th>
                            <th class="nombre-columna">Placa</th>
                            <th class="nombre-columna">Cédula</th>
                            <th class="nombre-columna">Fecha de ingreso</th>
                            <th class="nombre-columna">Fecha de salida</th>
                            <th class="columna-opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($this->estadias) == 0): ?>
                            <tr class="registro">
                                <td class="campo" colspan="6">No se encontró ninguna estadía</td>
                            </tr>
                        <?php endif ?>
                        <?php foreach($this->estadias as $estadia): ?>
                            <tr class="registro">
                                <td class="campo"><?php echo $estadia['codigo'] ?></td>
                                <td class="campo"><?php echo $estadia['placa'] ?></td>
                                <td class="campo"><?php echo $estadia['cedula'] ?></td>
                                <td class="campo"><?php echo $estadia['fecha_ingreso'] ?></td>
                                <td class="campo"><?php echo $estadia['fecha_salida'] ?></td>
                                <td class="opciones">
                                    <a class="ver" href="?url=cuenta&accion=ver-estadia">Ver</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if ($this->cantidadEstadias > $this->cantidadPorPagina): ?>
                    <div class="paginacion">
                        <div class="cantidad-registros">
                            <?php
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $inicio = ($page - 1) * $this->cantidadPorPagina;
                                $final = $inicio + count($this->estadias);
                                $rango = "Mostrando ".($inicio+1)."-".$final." estadías";
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