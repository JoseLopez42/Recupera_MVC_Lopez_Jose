<?php require_once __DIR__ . '/../header.php'; ?>

<div class="cabecera-seccion">
    <h1>Nuevo cliente</h1>
</div>

<?php if (!empty($error)): ?>
    <p class="alerta alerta-error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="Index.php?action=crear_cliente" class="formulario">

    <label for="documento">Número de documento</label>
    <input type="text" id="documento" name="documento"
           value="<?= htmlspecialchars($_POST['documento'] ?? '') ?>" required>

    <label for="nombre">Nombre completo</label>
    <input type="text" id="nombre" name="nombre"
           value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>

    <label for="correo">Correo electrónico</label>
    <input type="email" id="correo" name="correo"
           value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">

    <label for="telefono">Teléfono</label>
    <input type="text" id="telefono" name="telefono"
           value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">

    <div class="acciones-formulario">
        <button type="submit" class="btn btn-primario">Guardar cliente</button>
        <a href="Index.php?action=listar_clientes" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php require_once __DIR__ . '/../footer.php'; ?>
