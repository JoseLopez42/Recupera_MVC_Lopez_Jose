<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Reservas</h1>
    <a href="Index.php?action=crear_reserva" class="btn btn-primario">+ Nueva reserva</a>
</div>

<?php if (isset($_GET['ok'])): ?>
    <p class="alerta alerta-exito">Reserva registrada correctamente.</p>
<?php endif; ?>

<table class="tabla">
    <thead>
        <tr>
            <th>N.° reserva</th>
            <th>Cliente</th>
            <th>Documento</th>
            <th>Vuelo</th>
            <th>Ruta</th>
            <th>Fecha salida</th>
            <th>Precio</th>
            <th>Fecha de reserva</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($reservas)): ?>
            <tr>
                <td colspan="8" class="texto-vacio">Aún no hay reservas registradas.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td>#<?= (int) $reserva['id_reserva'] ?></td>
                    <td><?= htmlspecialchars($reserva['nombre']) ?></td>
                    <td><?= htmlspecialchars($reserva['documento']) ?></td>
                    <td><?= htmlspecialchars($reserva['numero_vuelo']) ?> (<?= htmlspecialchars($reserva['aerolinea']) ?>)</td>
                    <td><?= htmlspecialchars($reserva['origen']) ?> → <?= htmlspecialchars($reserva['destino']) ?></td>
                    <td><?= htmlspecialchars($reserva['fecha_salida']) ?></td>
                    <td>$<?= number_format((float) $reserva['precio'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($reserva['fecha_reserva']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../footer.php'; ?>
