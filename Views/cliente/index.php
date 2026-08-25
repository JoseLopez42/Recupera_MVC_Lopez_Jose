<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Clientes</h1>
    <a href="Index.php?action=crear_cliente" class="btn btn-primario">Nuevo cliente</a>
</div>

<?php if (isset($_GET['ok'])): ?>
    <p class="alerta alerta-exito">Cliente guardado correctamente.</p>
<?php endif; ?>

<table class="tabla">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombre completo</th>
            <th>Correo</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($clientes)): ?>
            <tr>
                <td colspan="4" class="texto-vacio">Aún no hay clientes registrados.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente['documento']) ?></td>
                    <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                    <td><?= htmlspecialchars($cliente['correo']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                    
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../footer.php'; ?>
