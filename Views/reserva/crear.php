<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Nueva reserva</h1>
</div>

<?php if (!empty($error)): ?>
    <p class="alerta alerta-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (empty($clientes) || empty($vuelos)): ?>
    <p class="alerta alerta-error">
        Debe existir al menos un cliente y un vuelo registrados antes de crear una reserva.
    </p>
<?php else: ?>

    <form method="POST" action="Index.php?action=crear_reserva" class="formulario">

        <label for="documento">Cliente</label>
        <select id="documento" name="documento" required>
            <option value="">-- Seleccione un cliente --</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= (int) $cliente['documento'] ?>">
                    <?= htmlspecialchars($cliente['nombre']) ?> (<?= htmlspecialchars($cliente['documento']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="numero_vuelo">Vuelo</label>
        <select id="numero_vuelo" name="numero_vuelo" required>
            <option value="">-- Seleccione un vuelo --</option>
            <?php foreach ($vuelos as $vuelo): ?>
                <option value="<?= $vuelo['numero_vuelo'] ?>">
                    <?= htmlspecialchars($vuelo['numero_vuelo']) ?> - <?= htmlspecialchars($vuelo['origen']) ?> → <?= htmlspecialchars($vuelo['destino']) ?>
                    (<?= htmlspecialchars($vuelo['fecha_salida']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <div class="acciones-formulario">
            <button type="submit" class="btn btn-primario">Registrar reserva</button>
            <a href="Index.php?action=listar_reservas" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>

<?php endif; ?>

<?php require_once __DIR__ . '/../footer.php'; ?>
