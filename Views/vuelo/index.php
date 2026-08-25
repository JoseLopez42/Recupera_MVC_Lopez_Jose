<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Vuelos disponibles</h1>
    <a href="Index.php?action=crear_vuelo" class="btn btn-primario">+ Nuevo vuelo</a>
</div>

<?php if (isset($_GET['ok'])): ?>
    <p class="alerta alerta-exito">Vuelo guardado correctamente.</p>
<?php endif; ?>

<table class="tabla">
    <thead>
        <tr>
            <th>N.° vuelo</th>
            <th>Aerolínea</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha salida</th>
            <th>Precio</th>
            <th>Capacidad</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($vuelos)): ?>
            <tr>
                <td colspan="8" class="texto-vacio">Aún no hay vuelos registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($vuelos as $vuelo): ?>
                <tr>
                    <td><?= htmlspecialchars($vuelo['numero_vuelo']) ?></td>
                    <td><?= htmlspecialchars($vuelo['aerolinea']) ?></td>
                    <td><?= htmlspecialchars($vuelo['origen']) ?></td>
                    <td><?= htmlspecialchars($vuelo['destino']) ?></td>
                    <td><?= htmlspecialchars($vuelo['fecha_salida']) ?></td>
                    <td>$<?= number_format((float) $vuelo['precio'], 0, ',', '.') ?></td>
                    <td><?= (int) $vuelo['capacidad_maxima'] ?></td>
                    <td>
                        <a href="Index.php?action=editar_vuelo&numero_vuelo=<?= urlencode($vuelo['numero_vuelo']) ?>" class="btn btn-pequeno">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../footer.php'; ?>
